<?php

declare (strict_types=1);
namespace PoP\ComponentModel\TypeResolvers\ScalarType;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use stdClass;
class AnyScalarScalarTypeResolver extends \PoP\ComponentModel\TypeResolvers\ScalarType\AbstractScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'AnyScalar';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Wildcard type representing any of GraphQL\'s scalar types, including built-in types (String, Int, Boolean, Float or ID) and custom types', 'component-model');
    }
    /**
     * Accept anything and everything
     * @param string|int|float|bool|\stdClass $inputValue
     * @return string|int|float|bool|object|null
     */
    public function coerceValue($inputValue, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        return $inputValue;
    }
}
