<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\ScalarType\AbstractFloatScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use stdClass;
/**
 * GraphQL Built-in Scalar
 *
 * @see https://spec.graphql.org/draft/#sec-Scalars.Built-in-Scalars
 */
class PositiveFloatScalarTypeResolver extends AbstractFloatScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'PositiveFloat';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('A positive float or 0.', 'extended-schema-commons');
    }
    /**
     * @param string|int|float|bool|\stdClass $inputValue
     * @return string|int|float|bool|object|null
     */
    public function coerceValue($inputValue, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $castInputValue = parent::coerceValue($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
        if ($castInputValue === null) {
            return null;
        }
        /** @var float $castInputValue */
        if ($castInputValue < 0) {
            $this->addDefaultError($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
            return null;
        }
        return $castInputValue;
    }
}
