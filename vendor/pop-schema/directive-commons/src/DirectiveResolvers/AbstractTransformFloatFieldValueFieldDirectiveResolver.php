<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons\DirectiveResolvers;

use PoPSchema\DirectiveCommons\FeedbackItemProviders\FeedbackItemProvider;
use PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\AnyBuiltInScalarScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\FloatScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\NumericScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
/** @internal */
abstract class AbstractTransformFloatFieldValueFieldDirectiveResolver extends \PoPSchema\DirectiveCommons\DirectiveResolvers\AbstractTransformTypedFieldValueFieldDirectiveResolver
{
    /**
     * @return array<class-string<ConcreteTypeResolverInterface>>|null
     */
    protected function getSupportedFieldTypeResolverClasses() : ?array
    {
        return [FloatScalarTypeResolver::class, NumericScalarTypeResolver::class, AnyBuiltInScalarScalarTypeResolver::class];
    }
    /**
     * @param mixed $value
     */
    protected function isMatchingType($value) : bool
    {
        return \is_float($value) || \is_integer($value);
    }
    /**
     * @param mixed $value
     * @return mixed TypedDataValidationPayload if error, or the value otherwise
     */
    protected final function transformTypeValue($value)
    {
        return $this->transformFloatValue((float) $value);
    }
    /**
     * @return float|\PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload
     */
    protected abstract function transformFloatValue(float $value);
    /**
     * Validate the value against the directive args
     *
     * @param mixed $value
     */
    protected final function validateTypeData($value) : ?TypedDataValidationPayload
    {
        return $this->validateFloatData((float) $value);
    }
    protected function validateFloatData(float $value) : ?TypedDataValidationPayload
    {
        return null;
    }
    /**
     * @param string|int $id
     * @param mixed $value
     */
    protected function getNonMatchingTypeValueFeedbackItemResolution($value, $id, FieldInterface $field, RelationalTypeResolverInterface $relationalTypeResolver) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E5, [$this->getDirectiveName(), $field->getOutputKey(), $id]);
    }
}
