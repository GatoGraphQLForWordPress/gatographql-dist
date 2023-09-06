<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons\DirectiveResolvers;

use PoPSchema\DirectiveCommons\FeedbackItemProviders\FeedbackItemProvider;
use PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\AnyBuiltInScalarScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
abstract class AbstractTransformStringFieldValueFieldDirectiveResolver extends \PoPSchema\DirectiveCommons\DirectiveResolvers\AbstractTransformTypedFieldValueFieldDirectiveResolver
{
    /**
     * @return array<class-string<ConcreteTypeResolverInterface>>|null
     */
    protected function getSupportedFieldTypeResolverClasses() : ?array
    {
        return [StringScalarTypeResolver::class, IDScalarTypeResolver::class, AnyBuiltInScalarScalarTypeResolver::class];
    }
    /**
     * @param mixed $value
     */
    protected function isMatchingType($value) : bool
    {
        return \is_string($value);
    }
    /**
     * @param mixed $value
     * @return mixed TypedDataValidationPayload if error, or the value otherwise
     */
    protected final function transformTypeValue($value)
    {
        return $this->transformStringValue($value);
    }
    /**
     * @return string|\PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload
     */
    protected abstract function transformStringValue(string $value);
    /**
     * Validate the value against the directive args
     *
     * @param mixed $value
     */
    protected final function validateTypeData($value) : ?TypedDataValidationPayload
    {
        return $this->validateStringData($value);
    }
    protected function validateStringData(string $value) : ?TypedDataValidationPayload
    {
        return null;
    }
    /**
     * @param string|int $id
     * @param mixed $value
     */
    protected function getNonMatchingTypeValueFeedbackItemResolution($value, $id, FieldInterface $field, RelationalTypeResolverInterface $relationalTypeResolver) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E2, [$this->getDirectiveName(), $field->getOutputKey(), $id]);
    }
}
