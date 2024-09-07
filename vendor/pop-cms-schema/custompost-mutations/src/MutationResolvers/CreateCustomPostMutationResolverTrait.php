<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\Exception\AbstractException;
use PoPCMSSchema\CustomPostMutations\Exception\CustomPostCRUDMutationException;
/** @internal */
trait CreateCustomPostMutationResolverTrait
{
    /**
     * @throws AbstractException In case of error
     * @return mixed
     */
    public function executeMutation(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        return $this->create($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @return string|int The ID of the created entity
     * @throws CustomPostCRUDMutationException If there was an error (eg: some Custom Post creation validation failed)
     */
    protected abstract function create(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore);
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $this->validateCreateErrors($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected abstract function validateCreateErrors(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void;
}
