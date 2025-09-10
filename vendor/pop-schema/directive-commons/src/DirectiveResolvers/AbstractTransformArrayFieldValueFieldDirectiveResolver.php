<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons\DirectiveResolvers;

use PoPSchema\DirectiveCommons\FeedbackItemProviders\FeedbackItemProvider;
use PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
/** @internal */
abstract class AbstractTransformArrayFieldValueFieldDirectiveResolver extends \PoPSchema\DirectiveCommons\DirectiveResolvers\AbstractTransformTypedFieldValueFieldDirectiveResolver
{
    protected function isMatchingType(mixed $value) : bool
    {
        return \is_array($value);
    }
    /**
     * @param mixed[] $value
     * @return mixed TypedDataValidationPayload if error, or the value otherwise
     */
    protected final function transformTypeValue(mixed $value) : mixed
    {
        return $this->transformArrayValue($value);
    }
    /**
     * @param mixed[] $value
     * @return mixed[]|TypedDataValidationPayload
     */
    protected abstract function transformArrayValue(array $value) : array|TypedDataValidationPayload;
    /**
     * Validate the value against the directive args
     *
     * @param mixed[] $value
     */
    protected final function validateTypeData(mixed $value) : ?TypedDataValidationPayload
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
    protected function getNonMatchingTypeValueFeedbackItemResolution(mixed $value, string|int $id, FieldInterface $field, RelationalTypeResolverInterface $relationalTypeResolver) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E7, [$this->getDirectiveName(), $field->getOutputKey(), $id]);
    }
}
