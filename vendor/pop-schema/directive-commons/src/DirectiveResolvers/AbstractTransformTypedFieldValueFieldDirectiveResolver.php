<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons\DirectiveResolvers;

use PoPSchema\DirectiveCommons\FeedbackItemProviders\FeedbackItemProvider;
use PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload;
use PoP\ComponentModel\Engine\EngineIterationFieldSet;
use PoP\ComponentModel\Feedback\EngineIterationFeedbackStore;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectResolutionFeedback;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use SplObjectStorage;
abstract class AbstractTransformTypedFieldValueFieldDirectiveResolver extends \PoPSchema\DirectiveCommons\DirectiveResolvers\AbstractTransformFieldValueFieldDirectiveResolver
{
    /**
     * @param array<array<string|int,EngineIterationFieldSet>> $succeedingPipelineIDFieldSet
     * @param array<string|int,SplObjectStorage<FieldInterface,mixed>> $resolvedIDFieldValues
     * @param string|int $id
     * @param mixed $value
     * @return mixed
     */
    protected final function transformValue($value, $id, FieldInterface $field, RelationalTypeResolverInterface $relationalTypeResolver, array &$succeedingPipelineIDFieldSet, array &$resolvedIDFieldValues, EngineIterationFeedbackStore $engineIterationFeedbackStore)
    {
        if ($value === null && $this->skipNullValue()) {
            return null;
        }
        if (!$this->isMatchingType($value)) {
            $this->handleError($value, $id, $field, $relationalTypeResolver, $succeedingPipelineIDFieldSet, $resolvedIDFieldValues, $this->getNonMatchingTypeValueFeedbackItemResolution($value, $id, $field, $relationalTypeResolver), $this->directive, $engineIterationFeedbackStore);
            return null;
        }
        $typedDataValidationPayload = $this->validateTypeData($value);
        if ($typedDataValidationPayload !== null) {
            $this->handleError($value, $id, $field, $relationalTypeResolver, $succeedingPipelineIDFieldSet, $resolvedIDFieldValues, $typedDataValidationPayload->feedbackItemResolution, $typedDataValidationPayload->astNode ?? $this->directive, $engineIterationFeedbackStore);
            return null;
        }
        /**
         * Also the actual transformation could raise errors,
         * and these can't be validated on the step before.
         *
         * Eg: `preg_replace` may throw an error if the regex
         * pattern is not right.
         */
        $transformedTypeValue = $this->transformTypeValue($value);
        if ($transformedTypeValue instanceof TypedDataValidationPayload) {
            /** @var TypedDataValidationPayload */
            $typedDataValidationPayload = $transformedTypeValue;
            $this->handleError($value, $id, $field, $relationalTypeResolver, $succeedingPipelineIDFieldSet, $resolvedIDFieldValues, $typedDataValidationPayload->feedbackItemResolution, $typedDataValidationPayload->astNode ?? $this->directive, $engineIterationFeedbackStore);
            return null;
        }
        return $transformedTypeValue;
    }
    protected function skipNullValue() : bool
    {
        return \true;
    }
    /**
     * @param mixed $value
     */
    protected abstract function isMatchingType($value) : bool;
    /**
     * Validate the value against the directive args
     * @param mixed $value
     */
    protected function validateTypeData($value) : ?TypedDataValidationPayload
    {
        return null;
    }
    /**
     * @return mixed TypedDataValidationPayload if error, or the value otherwise
     * @param mixed $value
     */
    protected abstract function transformTypeValue($value);
    /**
     * @param array<array<string|int,EngineIterationFieldSet>> $succeedingPipelineIDFieldSet
     * @param array<string|int,SplObjectStorage<FieldInterface,mixed>> $resolvedIDFieldValues
     * @param string|int $id
     * @param mixed $value
     */
    private function handleError($value, $id, FieldInterface $field, RelationalTypeResolverInterface $relationalTypeResolver, array &$succeedingPipelineIDFieldSet, array &$resolvedIDFieldValues, FeedbackItemResolution $feedbackItemResolution, AstInterface $astNode, EngineIterationFeedbackStore $engineIterationFeedbackStore) : void
    {
        /** @var array<string|int,EngineIterationFieldSet> */
        $idFieldSetToRemove = [$id => new EngineIterationFieldSet([$field])];
        $this->removeIDFieldSet($succeedingPipelineIDFieldSet, $idFieldSetToRemove);
        $this->setFieldResponseValueAsNull($resolvedIDFieldValues, $idFieldSetToRemove);
        $engineIterationFeedbackStore->objectResolutionFeedbackStore->addError(new ObjectResolutionFeedback($feedbackItemResolution, $astNode, $relationalTypeResolver, $this->directive, $idFieldSetToRemove));
    }
    /**
     * @param string|int $id
     * @param mixed $value
     */
    protected function getNonMatchingTypeValueFeedbackItemResolution($value, $id, FieldInterface $field, RelationalTypeResolverInterface $relationalTypeResolver) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E1, [$this->getDirectiveName(), $field->getOutputKey(), $id]);
    }
}
