<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\MutationResolvers;

use PoPCMSSchema\CustomPostMediaMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
trait SetFeaturedImageOnCustomPostMutationResolverTrait
{
    /**
     * @param string|int $mediaItemID
     */
    protected function validateMediaItemByIDExists($mediaItemID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->getMediaTypeAPI()->mediaItemByIDExists($mediaItemID)) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2, [$mediaItemID]), $fieldDataAccessor->getField()));
        }
    }
    protected function validateMediaItemBySlugExists(string $mediaItemSlug, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->getMediaTypeAPI()->mediaItemBySlugExists($mediaItemSlug)) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5, [$mediaItemSlug]), $fieldDataAccessor->getField()));
        }
    }
    protected abstract function getMediaTypeAPI() : MediaTypeAPIInterface;
}
