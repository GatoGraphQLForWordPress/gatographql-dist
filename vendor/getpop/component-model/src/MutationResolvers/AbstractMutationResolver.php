<?php

declare (strict_types=1);
namespace PoP\ComponentModel\MutationResolvers;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Services\AbstractBasicService;
/** @internal */
abstract class AbstractMutationResolver extends AbstractBasicService implements \PoP\ComponentModel\MutationResolvers\MutationResolverInterface
{
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
    }
    public function getErrorType() : int
    {
        return \PoP\ComponentModel\MutationResolvers\ErrorTypes::DESCRIPTIONS;
    }
}
