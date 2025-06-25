<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType;

use PoPSchema\ExtendedSchemaCommons\FeedbackItemProviders\InputValueCoercionErrorFeedbackItemProvider;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use stdClass;
/**
 * GraphQL Custom Scalar
 *
 * An identifier string scalar type that validates the string matches the pattern [a-zA-Z_][a-zA-Z0-9_]*.
 * @internal
 */
class IdentifierStringScalarTypeResolver extends StringScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'IdentifierString';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('An identifier string scalar type that validates the string matches the pattern [a-zA-Z_][a-zA-Z0-9_]*.', 'extended-schema-commons');
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
        /** @var string $castInputValue */
        if (\trim($castInputValue) === '') {
            $this->addDefaultError($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
            return null;
        }
        // Validate identifier pattern: [a-zA-Z_][a-zA-Z0-9_]*
        if (!\preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $castInputValue)) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(InputValueCoercionErrorFeedbackItemProvider::class, InputValueCoercionErrorFeedbackItemProvider::E4, [$castInputValue, $this->getMaybeNamespacedTypeName()]), $astNode));
            return null;
        }
        return $castInputValue;
    }
}
