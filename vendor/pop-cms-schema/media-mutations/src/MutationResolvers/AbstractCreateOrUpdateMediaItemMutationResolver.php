<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\MediaMutations\Constants\HookNames;
use PoPCMSSchema\MediaMutations\Constants\MutationInputProperties;
use PoPCMSSchema\MediaMutations\FeedbackItemProviders\MutationErrorFeedbackItemProvider;
use PoPCMSSchema\MediaMutations\LooseContracts\LooseContractSet;
use PoPCMSSchema\MediaMutations\MutationResolvers\MediaItemCRUDMutationResolverTrait;
use PoPCMSSchema\MediaMutations\TypeAPIs\MediaTypeMutationAPIInterface;
use PoPCMSSchema\Media\Constants\InputProperties;
use PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface;
use PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface;
use PoPCMSSchema\UserStateMutations\MutationResolvers\ValidateUserLoggedInMutationResolverTrait;
use PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface;
use PoP\ComponentModel\Feedback\FeedbackItemResolution;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedback;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\LooseContracts\NameResolverInterface;
use PoP\Root\App;
use stdClass;
/** @internal */
abstract class AbstractCreateOrUpdateMediaItemMutationResolver extends AbstractMutationResolver
{
    use ValidateUserLoggedInMutationResolverTrait;
    use MediaItemCRUDMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeAPIs\MediaTypeMutationAPIInterface|null
     */
    private $mediaTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\Users\TypeAPIs\UserTypeAPIInterface|null
     */
    private $userTypeAPI;
    /**
     * @var \PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface|null
     */
    private $userRoleTypeAPI;
    /**
     * @var \PoP\LooseContracts\NameResolverInterface|null
     */
    private $nameResolver;
    /**
     * @var \PoPCMSSchema\Media\TypeAPIs\MediaTypeAPIInterface|null
     */
    private $mediaTypeAPI;
    public final function setMediaTypeMutationAPI(MediaTypeMutationAPIInterface $mediaTypeMutationAPI) : void
    {
        $this->mediaTypeMutationAPI = $mediaTypeMutationAPI;
    }
    protected final function getMediaTypeMutationAPI() : MediaTypeMutationAPIInterface
    {
        if ($this->mediaTypeMutationAPI === null) {
            /** @var MediaTypeMutationAPIInterface */
            $mediaTypeMutationAPI = $this->instanceManager->getInstance(MediaTypeMutationAPIInterface::class);
            $this->mediaTypeMutationAPI = $mediaTypeMutationAPI;
        }
        return $this->mediaTypeMutationAPI;
    }
    public final function setUserTypeAPI(UserTypeAPIInterface $userTypeAPI) : void
    {
        $this->userTypeAPI = $userTypeAPI;
    }
    protected final function getUserTypeAPI() : UserTypeAPIInterface
    {
        if ($this->userTypeAPI === null) {
            /** @var UserTypeAPIInterface */
            $userTypeAPI = $this->instanceManager->getInstance(UserTypeAPIInterface::class);
            $this->userTypeAPI = $userTypeAPI;
        }
        return $this->userTypeAPI;
    }
    public final function setUserRoleTypeAPI(UserRoleTypeAPIInterface $userRoleTypeAPI) : void
    {
        $this->userRoleTypeAPI = $userRoleTypeAPI;
    }
    protected final function getUserRoleTypeAPI() : UserRoleTypeAPIInterface
    {
        if ($this->userRoleTypeAPI === null) {
            /** @var UserRoleTypeAPIInterface */
            $userRoleTypeAPI = $this->instanceManager->getInstance(UserRoleTypeAPIInterface::class);
            $this->userRoleTypeAPI = $userRoleTypeAPI;
        }
        return $this->userRoleTypeAPI;
    }
    public final function setNameResolver(NameResolverInterface $nameResolver) : void
    {
        $this->nameResolver = $nameResolver;
    }
    protected final function getNameResolver() : NameResolverInterface
    {
        if ($this->nameResolver === null) {
            /** @var NameResolverInterface */
            $nameResolver = $this->instanceManager->getInstance(NameResolverInterface::class);
            $this->nameResolver = $nameResolver;
        }
        return $this->nameResolver;
    }
    public final function setMediaTypeAPI(MediaTypeAPIInterface $mediaTypeAPI) : void
    {
        $this->mediaTypeAPI = $mediaTypeAPI;
    }
    protected final function getMediaTypeAPI() : MediaTypeAPIInterface
    {
        if ($this->mediaTypeAPI === null) {
            /** @var MediaTypeAPIInterface */
            $mediaTypeAPI = $this->instanceManager->getInstance(MediaTypeAPIInterface::class);
            $this->mediaTypeAPI = $mediaTypeAPI;
        }
        return $this->mediaTypeAPI;
    }
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        $field = $fieldDataAccessor->getField();
        $errorCount = $objectTypeFieldResolutionFeedbackStore->getErrorCount();
        if ($this->addMediaItemInputField()) {
            // If updating a media item, check that it exists
            /** @var string|int */
            $mediaItemID = $fieldDataAccessor->getValue(MutationInputProperties::ID);
            $this->validateMediaItemByIDExists($mediaItemID, InputProperties::ID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
        // Check that the user is logged-in
        $errorFeedbackItemResolution = $this->validateUserIsLoggedIn();
        if ($errorFeedbackItemResolution !== null) {
            $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback($errorFeedbackItemResolution, $field));
        }
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        $this->validateCanLoggedInUserEditMediaItems($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        if ($objectTypeFieldResolutionFeedbackStore->getErrorCount() > $errorCount) {
            return;
        }
        /** @var int|string|null */
        $authorID = $fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_ID);
        if ($authorID !== null) {
            // If providing the author, check that the user exists
            if ($this->getUserTypeAPI()->getUserByID($authorID) === null) {
                $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E5, [$authorID]), $field));
            }
        }
        // Validate the user can edit the attachment
        if ($this->addMediaItemInputField()) {
            /** @var string|int */
            $mediaItemID = $fieldDataAccessor->getValue(MutationInputProperties::ID);
            $this->validateCanLoggedInUserEditMediaItem($mediaItemID, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
        if ($this->canUploadAttachment()) {
            $currentUserID = App::getState('current-user-id');
            // Validate the user has the needed capability to upload files
            $uploadFilesCapability = $this->getNameResolver()->getName(LooseContractSet::NAME_UPLOAD_FILES_CAPABILITY);
            if (!$this->getUserRoleTypeAPI()->userCan($currentUserID, $uploadFilesCapability)) {
                $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E2), $fieldDataAccessor->getField()));
            } elseif ($authorID !== null && $authorID !== $currentUserID) {
                // Validate the logged-in user has the capability to upload files for other people
                $uploadFilesForOtherUsersCapability = $this->getNameResolver()->getName(LooseContractSet::NAME_UPLOAD_FILES_FOR_OTHER_USERS_CAPABILITY);
                if (!$this->getUserRoleTypeAPI()->userCan($currentUserID, $uploadFilesForOtherUsersCapability)) {
                    $objectTypeFieldResolutionFeedbackStore->addError(new ObjectTypeFieldResolutionFeedback(new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E4), $fieldDataAccessor->getField()));
                }
            }
            // If providing an existing media item, check that it exists
            /** @var stdClass */
            $from = $fieldDataAccessor->getValue(MutationInputProperties::FROM);
            if (isset($from->{MutationInputProperties::MEDIAITEM_BY})) {
                /** @var stdClass */
                $mediaItemBy = $from->{MutationInputProperties::MEDIAITEM_BY};
                if (isset($mediaItemBy->{InputProperties::ID})) {
                    /** @var string|int */
                    $mediaItemID = $mediaItemBy->{InputProperties::ID};
                    $this->validateMediaItemByIDExists($mediaItemID, MutationInputProperties::FROM, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
                } elseif (isset($mediaItemBy->{InputProperties::SLUG})) {
                    /** @var string */
                    $mediaItemSlug = $mediaItemBy->{InputProperties::SLUG};
                    $this->validateMediaItemBySlugExists($mediaItemSlug, MutationInputProperties::FROM, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
                }
            }
        }
        // Allow components to inject their own validations
        App::doAction(HookNames::VALIDATE_CREATE_OR_UPDATE_MEDIA_ITEM, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    protected abstract function addMediaItemInputField() : bool;
    protected abstract function canUploadAttachment() : bool;
    protected function getUserNotLoggedInError() : FeedbackItemResolution
    {
        return new FeedbackItemResolution(MutationErrorFeedbackItemProvider::class, MutationErrorFeedbackItemProvider::E1);
    }
    /**
     * @param string|int $mediaItemID
     */
    protected function additionals($mediaItemID, FieldDataAccessorInterface $fieldDataAccessor) : void
    {
        App::doAction(HookNames::CREATE_OR_UPDATE_MEDIA_ITEM, $mediaItemID, $fieldDataAccessor);
    }
    /**
     * @return array<string,mixed>
     */
    protected function getMediaItemData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        $mediaItemData = ['authorID' => $fieldDataAccessor->getValue(MutationInputProperties::AUTHOR_ID), 'title' => $fieldDataAccessor->getValue(MutationInputProperties::TITLE), 'slug' => $fieldDataAccessor->getValue(MutationInputProperties::SLUG), 'caption' => $fieldDataAccessor->getValue(MutationInputProperties::CAPTION), 'description' => $fieldDataAccessor->getValue(MutationInputProperties::DESCRIPTION), 'altText' => $fieldDataAccessor->getValue(MutationInputProperties::ALT_TEXT), 'mimeType' => $fieldDataAccessor->getValue(MutationInputProperties::MIME_TYPE)];
        if ($this->addMediaItemInputField()) {
            $mediaItemData['id'] = $fieldDataAccessor->getValue(MutationInputProperties::ID);
        }
        // Inject custom post ID, etc
        $mediaItemData = App::applyFilters(HookNames::GET_CREATE_OR_UPDATE_MEDIA_ITEM_DATA, $mediaItemData, $fieldDataAccessor);
        return $mediaItemData;
    }
}
