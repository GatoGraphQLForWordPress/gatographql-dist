<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\ScalarType;

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
class HTMLScalarTypeResolver extends AbstractScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'HTML';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('HTML scalar, such as "<p>Hello <strong>world</strong>!</p>"', 'component-model');
    }
    public function getSpecifiedByURL() : ?string
    {
        return 'https://datatracker.ietf.org/doc/rfc1866/';
    }
    /**
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
        return (string) $inputValue;
    }
}
