<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\MediaMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\MediaMutations\ObjectModels\LoggedInUserHasNoEditingMediaCapabilityErrorPayload;
use PoPCMSSchema\MediaMutations\ObjectModels\LoggedInUserHasNoPermissionToEditMediaItemErrorPayload;
use PoPCMSSchema\MediaMutations\ObjectModels\MediaItemDoesNotExistErrorPayload;
use PoPCMSSchema\MediaMutations\ObjectModels\UserDoesNotExistErrorPayload;
use PoPCMSSchema\MediaMutations\ObjectModels\UserHasNoPermissionToUploadFilesErrorPayload;
use PoPCMSSchema\MediaMutations\ObjectModels\UserHasNoPermissionToUploadFilesForOtherUsersErrorPayload;
use PoPCMSSchema\MediaMutations\TypeAPIs\MediaTypeMutationAPIInterface;
use PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface;
use PoPCMSSchema\UserStateMutations\ObjectModels\UserIsNotLoggedInErrorPayload;
use PoPSchema\SchemaCommons\ObjectModels\ErrorPayloadInterface;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackInterface;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
/** @internal */
trait MediaItemCRUDMutationResolverTrait
{
    /**
     * @param string|int $mediaItemID
     */
    protected function validateMediaItemByIDExists($mediaItemID, ?string $fieldInputName, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->getMediaTypeAPI()->mediaItemByIDExists($mediaItemID)) {
            $field = $fieldDataAccessor->getField();
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6, [$mediaItemID]), $fieldInputName !== null ? $field->getArgument($fieldInputName) ?? $field : $field));
        }
    }
    protected function validateMediaItemBySlugExists(string $mediaItemSlug, string $fieldInputName, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        if (!$this->getMediaTypeAPI()->mediaItemBySlugExists($mediaItemSlug)) {
            $field = $fieldDataAccessor->getField();
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7, [$mediaItemSlug]), $field->getArgument($fieldInputName) ?? $field));
        }
    }
    public function createOrUpdateMediaItemErrorPayloadFromObjectTypeFieldResolutionFeedback(ObjectTypeFieldResolutionFeedbackInterface $objectTypeFieldResolutionFeedback) : ?ErrorPayloadInterface
    {
        $feedbackItemResolution = $objectTypeFieldResolutionFeedback->getFeedbackItemResolution();
        switch ([$feedbackItemResolution->getFeedbackProviderServiceClass(), $feedbackItemResolution->getCode()]) {
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1]:
                return new UserIsNotLoggedInErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2]:
                return new UserHasNoPermissionToUploadFilesErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E4]:
                return new UserHasNoPermissionToUploadFilesForOtherUsersErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5]:
                return new UserDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E6]:
                return new MediaItemDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E7]:
                return new MediaItemDoesNotExistErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E8]:
                return new LoggedInUserHasNoPermissionToEditMediaItemErrorPayload($feedbackItemResolution->getMessage());
            case [MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E9]:
                return new LoggedInUserHasNoEditingMediaCapabilityErrorPayload($feedbackItemResolution->getMessage());
            default:
                return null;
        }
    }
    protected abstract function getMediaTypeAPI() : MediaTypeAPIInterface;
    /**
     * @param string|int $mediaItemID
     */
    protected function validateCanLoggedInUserEditMediaItem($mediaItemID, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $userID = App::getState('current-user-id');
        if (!$this->getMediaTypeMutationAPI()->canUserEditMediaItem($userID, $mediaItemID)) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E8, [$mediaItemID]), $fieldDataAccessor->getField()));
        }
    }
    protected abstract function getMediaTypeMutationAPI() : MediaTypeMutationAPIInterface;
    protected function validateCanLoggedInUserEditMediaItems(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $userID = App::getState('current-user-id');
        if (!$this->getMediaTypeMutationAPI()->canUserEditMediaItems($userID)) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E9), $fieldDataAccessor->getField()));
        }
    }
}
