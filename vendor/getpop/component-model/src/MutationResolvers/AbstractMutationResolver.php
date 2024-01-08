<?php

declare (strict_types=1);
namespace PoP\ComponentModel\MutationResolvers;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Services\BasicServiceTrait;
/** @internal */
abstract class AbstractMutationResolver implements \PoP\ComponentModel\MutationResolvers\MutationResolverInterface
{
    use BasicServiceTrait;
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
    }
    public function getErrorType() : int
    {
        return \PoP\ComponentModel\MutationResolvers\ErrorTypes::DESCRIPTIONS;
    }
}
