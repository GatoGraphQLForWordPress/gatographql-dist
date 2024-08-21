<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\MediaMutations\Constants\HookNames;
use PoPCMSSchema\MediaMutations\Exception\MediaItemCRUDMutationException;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\Root\App;
use PoP\Root\Exception\AbstractException;
/** @internal */
class UpdateMediaItemMutationResolver extends \PoPCMSSchema\MediaMutations\MutationResolvers\AbstractCreateOrUpdateMediaItemMutationResolver
{
    protected function addMediaItemInputField() : bool
    {
        return \true;
    }
    protected function canUploadAttachment() : bool
    {
        return \false;
    }
    public function validate(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore) : void
    {
        parent::validate($fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        // Allow components to inject their own validations
        App::doAction(HookNames::VALIDATE_UPDATE_MEDIA_ITEM, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * @param string|int $mediaItemID
     */
    protected function additionals($mediaItemID, FieldDataAccessorInterface $fieldDataAccessor) : void
    {
        parent::additionals($mediaItemID, $fieldDataAccessor);
        App::doAction(HookNames::UPDATE_MEDIA_ITEM, $mediaItemID, $fieldDataAccessor);
    }
    /**
     * @return array<string,mixed>
     */
    protected function getMediaItemData(FieldDataAccessorInterface $fieldDataAccessor) : array
    {
        return App::applyFilters(HookNames::GET_UPDATE_MEDIA_ITEM_DATA, parent::getMediaItemData($fieldDataAccessor), $fieldDataAccessor);
    }
    /**
     * @throws MediaItemCRUDMutationException In case of error
     * @param array<string,mixed> $mediaItemData
     * @return string|int|null
     */
    protected function updateMediaItem(array $mediaItemData, FieldDataAccessorInterface $fieldDataAccessor)
    {
        /** @var string|int */
        $mediaItemID = $mediaItemData['id'];
        unset($mediaItemData['id']);
        $this->getMediaTypeMutationAPI()->updateMediaItem($mediaItemID, $mediaItemData);
        return $mediaItemID;
    }
    /**
     * @throws AbstractException In case of error
     * @return mixed
     */
    public function executeMutation(FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        $mediaItemData = $this->getMediaItemData($fieldDataAccessor);
        $mediaItemID = $this->updateMediaItem($mediaItemData, $fieldDataAccessor);
        if ($mediaItemID === null) {
            return null;
        }
        // Allow for additional operations
        $this->additionals($mediaItemID, $fieldDataAccessor);
        return $mediaItemID;
    }
}
