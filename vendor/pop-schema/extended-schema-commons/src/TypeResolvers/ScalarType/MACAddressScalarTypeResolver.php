<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\ScalarType\AbstractScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use stdClass;
/**
 * GraphQL Custom Scalar
 *
 * @see https://spec.graphql.org/draft/#sec-Scalars.Custom-Scalars
 * @internal
 */
class MACAddressScalarTypeResolver extends AbstractScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'MACAddress';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('MAC (media access control) address scalar, such as 00:1A:C2:7B:00:47', 'extended-schema-commons');
    }
    /**
     * @param string|int|float|bool|\stdClass $inputValue
     * @return string|int|float|bool|object|null
     */
    public function coerceValue($inputValue, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        $this->validateIsString($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return null;
        }
        /** @var string $inputValue */
        $this->validateFilterVar($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore, \FILTER_VALIDATE_MAC);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return null;
        }
        return $inputValue;
    }
}
