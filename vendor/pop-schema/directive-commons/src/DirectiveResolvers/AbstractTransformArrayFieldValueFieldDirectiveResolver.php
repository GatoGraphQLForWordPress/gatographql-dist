<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons\DirectiveResolvers;

use PoPSchema\DirectiveCommons\FeedbackItemProviders\FeedbackItemProvider;
use PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
abstract class AbstractTransformArrayFieldValueFieldDirectiveResolver extends \PoPSchema\DirectiveCommons\DirectiveResolvers\AbstractTransformTypedFieldValueFieldDirectiveResolver
{
    /**
     * @param mixed $value
     */
    protected function isMatchingType($value) : bool
    {
        return \is_array($value);
    }
    /**
     * @param mixed $value
     * @return mixed TypedDataValidationPayload if error, or the value otherwise
     */
    protected final function transformTypeValue($value)
    {
        return $this->transformArrayValue($value);
    }
    /**
     * @param mixed[] $value
     * @return mixed[]|TypedDataValidationPayload
     */
    protected abstract function transformArrayValue(array $value);
    /**
     * Validate the value against the directive args
     *
     * @param mixed $value
     */
    protected final function validateTypeData($value) : ?TypedDataValidationPayload
    {
        return $this->validateArrayData($value);
    }
    /**
     * @param mixed[] $value
     */
    protected function validateArrayData(array $value) : ?TypedDataValidationPayload
    {
        return null;
    }
    /**
     * @param string|int $id
     * @param mixed $value
     */
    protected function getNonMatchingTypeValueFeedbackItemResolution($value, $id, FieldInterface $field, RelationalTypeResolverInterface $relationalTypeResolver) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E7, [$this->getDirectiveName(), $field->getOutputKey(), $id]);
    }
}
