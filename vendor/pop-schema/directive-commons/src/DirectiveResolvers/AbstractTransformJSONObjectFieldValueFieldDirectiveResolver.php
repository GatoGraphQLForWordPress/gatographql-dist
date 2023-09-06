<?php

declare (strict_types=1);
namespace PoPSchema\DirectiveCommons\DirectiveResolvers;

use PoPSchema\DirectiveCommons\FeedbackItemProviders\FeedbackItemProvider;
use PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\RelationalTypeResolverInterface;
use PoP\Engine\TypeResolvers\ScalarType\JSONObjectScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use stdClass;
abstract class AbstractTransformJSONObjectFieldValueFieldDirectiveResolver extends \PoPSchema\DirectiveCommons\DirectiveResolvers\AbstractTransformTypedFieldValueFieldDirectiveResolver
{
    /**
     * @return array<class-string<ConcreteTypeResolverInterface>>|null
     */
    protected function getSupportedFieldTypeResolverClasses() : ?array
    {
        return [JSONObjectScalarTypeResolver::class];
    }
    /**
     * @param mixed $value
     */
    protected function isMatchingType($value) : bool
    {
        return $value instanceof stdClass;
    }
    /**
     * @param mixed $value
     * @return mixed TypedDataValidationPayload if error, or the value otherwise
     */
    protected final function transformTypeValue($value)
    {
        return $this->transformStdClassValue($value);
    }
    /**
     * @return \stdClass|\PoPSchema\DirectiveCommons\ObjectModels\TypedDataValidationPayload
     */
    protected abstract function transformStdClassValue(stdClass $value);
    /**
     * Validate the value against the directive args
     *
     * @param mixed $value
     */
    protected final function validateTypeData($value) : ?TypedDataValidationPayload
    {
        return $this->validateStdClassData($value);
    }
    protected function validateStdClassData(stdClass $value) : ?TypedDataValidationPayload
    {
        return null;
    }
    /**
     * @param string|int $id
     * @param mixed $value
     */
    protected function getNonMatchingTypeValueFeedbackItemResolution($value, $id, FieldInterface $field, RelationalTypeResolverInterface $relationalTypeResolver) : FeedbackItemResolution
    {
        return new FeedbackItemResolution(FeedbackItemProvider::class, FeedbackItemProvider::E6, [$this->getDirectiveName(), $field->getOutputKey(), $id]);
    }
}
