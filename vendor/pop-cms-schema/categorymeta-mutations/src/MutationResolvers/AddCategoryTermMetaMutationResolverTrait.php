<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\CategoryMetaMutations\Exception\CategoryTermMetaCRUDMutationException;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
trait AddCategoryTermMetaMutationResolverTrait
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
     * @return string|int The ID of the taxonomy term
     * @throws CategoryTermMetaCRUDMutationException If there was an error (eg: Custom Post does not exist)
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
