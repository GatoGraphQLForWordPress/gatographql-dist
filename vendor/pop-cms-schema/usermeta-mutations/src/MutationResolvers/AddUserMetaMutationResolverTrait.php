<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\MutationResolvers;

use PoPCMSSchema\UserMetaMutations\Exception\UserMetaCRUDMutationException;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
trait AddUserMetaMutationResolverTrait
{
    /**
     * @throws AbstractException In case of error
     * @return mixed
     */
    public function executeMutation(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        return $this->addMeta($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @return string|int The ID of the user
     * @throws UserMetaCRUDMutationException If there was an error (eg: User does not exist)
     */
    protected abstract function addMeta(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore);
    /**
     * Validate the app-level errors in top-level "errors" entry.
     */
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $this->validateAddMetaErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected abstract function validateAddMetaErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void;
}
