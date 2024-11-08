<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\ScalarType;

use GatoExternalPrefixByGatoGraphQL\CastToType;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\ScalarType\AbstractScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use stdClass;
/** @internal */
class NumericScalarTypeResolver extends AbstractScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'Numeric';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Wildcard type representing any of the numeric types (Int or Float)', 'schema-commons');
    }
    /**
     * Cast to either Int or Float
     * @param string|int|float|bool|\stdClass $inputValue
     * @return string|int|float|bool|object|null
     */
    public function coerceValue($inputValue, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $this->validateIsNotStdClass($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return null;
        }
        /** @var string|int|float|bool $inputValue */
        $castInputValue = CastToType::_int($inputValue);
        if ($castInputValue !== null) {
            return (int) $castInputValue;
        }
        $castInputValue = CastToType::_float($inputValue);
        if ($castInputValue !== null) {
            return (float) $castInputValue;
        }
        $this->addDefaultError($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
        return null;
    }
}
