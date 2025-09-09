<?php

declare (strict_types=1);
namespace PoP\ComponentModel\TypeResolvers\InputObjectType;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\GraphQLParser\Spec\Parser\Ast\AstInterface;
use stdClass;
/**
 * Oneof InputObject Type
 *
 * @see https://github.com/graphql/graphql-spec/pull/825
 * @internal
 */
abstract class AbstractOneofInputObjectTypeResolver extends \PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver implements \PoP\ComponentModel\TypeResolvers\InputObjectType\OneofInputObjectTypeResolverInterface
{
    use \PoP\ComponentModel\TypeResolvers\InputObjectType\OneofInputObjectTypeResolverTrait;
    /**
     * Validate that there is exactly one input set
     */
    protected function coerceInputObjectValue(stdClass $inputValue, AstInterface $astNode, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : ?stdClass
    {
        $this->validateOneofInputObjectValue($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrors() !== []) {
            return null;
        }
        return parent::coerceInputObjectValue($inputValue, $astNode, $objectTypeFieldResolutionFeedbackStore);
    }
}
