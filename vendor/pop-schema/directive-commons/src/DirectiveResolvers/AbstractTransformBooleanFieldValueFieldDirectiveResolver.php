<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons\DirectiveResolvers;

use PoPSchema\DirectiveCommons\FeedbackItemProviders\FeedbackItemProvider;
use PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\AnyBuiltInScalarScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
abstract class AbstractTransformBooleanFieldValueFieldDirectiveResolver extends \PoPSchema\DirectiveCommons\DirectiveResolvers\AbstractTransformTypedFieldValueFieldDirectiveResolver
{
    /**
     * @return array<class-string<ConcreteTypeResolverInterface>>|null
     */
    protected function getSupportedFieldTypeResolverClasses() : ?array
    {
        return [BooleanScalarTypeResolver::class, AnyBuiltInScalarScalarTypeResolver::class];
    }
    /**
     * @param mixed $value
     */
    protected function isMatchingType($value) : bool
    {
        return \is_bool($value);
    }
    /**
     * @param mixed $value
     * @return mixed TypedDataValidationPayload if error, or the value otherwise
     */
    protected final function transformTypeValue($value)
    {
        return $this->transformBoolValue($value);
    }
    /**
     * @return bool|\PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload
     */
    protected abstract function transformBoolValue(bool $value);
    /**
     * Validate the value against the directive args
     *
     * @param mixed $value
     */
    protected final function validateTypeData($value) : ?TypedDataValidationPayload
    {
        return $this->validateBoolData($value);
    }
    protected function validateBoolData(bool $value) : ?TypedDataValidationPayload
    {
        return null;
    }
    /**
     * @param string|int $id
     * @param mixed $value
     */
    protected function getNonMatchingTypeValueFeedbackItemResolution($value, $id, FieldInterface $field, RelationalTypeResolverInterface $relationalTypeResolver) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E3, [$this->getDirectiveName(), $field->getOutputKey(), $id]);
    }
}
