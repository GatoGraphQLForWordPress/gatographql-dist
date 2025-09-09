<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\CategoryMutations\Exception\CategoryTermCRUDMutationException;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
/** @internal */
trait DeleteCategoryTermMutationResolverTrait
{
    /**
     * @throws AbstractException In case of error
     */
    public function executeMutation(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : mixed
    {
        return $this->delete($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @return bool Was the deletion successful?
     * @throws CategoryTermCRUDMutationException If there was an error (eg: Custom Post does not exist)
     */
    protected abstract function delete(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : bool;
    /**
     * Validate the app-level errors in top-level "errors" entry.
     */
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $this->validateDeleteErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected abstract function validateDeleteErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void;
}
