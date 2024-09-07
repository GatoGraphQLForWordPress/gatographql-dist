<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\Constants;

/** @internal */
class MediaCRUDHookNames
{
    public const CREATE_OR_UPDATE_MEDIA_ITEM = __CLASS__ . ':createOrUpdateMediaItem';
    public const CREATE_MEDIA_ITEM = __CLASS__ . ':createMediaItem';
    public const UPDATE_MEDIA_ITEM = __CLASS__ . ':updateMediaItem';
    public const VALIDATE_CREATE_OR_UPDATE_MEDIA_ITEM = __CLASS__ . ':validateCreateOrUpdateMediaItem';
    public const VALIDATE_CREATE_MEDIA_ITEM = __CLASS__ . ':validateCreateMediaItem';
    public const VALIDATE_UPDATE_MEDIA_ITEM = __CLASS__ . ':validateUpdateMediaItem';
    public const GET_CREATE_OR_UPDATE_MEDIA_ITEM_DATA = __CLASS__ . ':getCreateOrUpdateMediaItemData';
    public const GET_CREATE_MEDIA_ITEM_DATA = __CLASS__ . ':getCreateMediaItemData';
    public const GET_UPDATE_MEDIA_ITEM_DATA = __CLASS__ . ':getUpdateMediaItemData';
    public const CREATE_OR_UPDATE_MEDIA_ITEM_INPUT_FIELD_NAME_TYPE_RESOLVERS = __CLASS__ . ':createOrUpdateMediaItemInputFieldNameTypeResolvers';
    public const CREATE_MEDIA_ITEM_INPUT_FIELD_NAME_TYPE_RESOLVERS = __CLASS__ . ':createMediaItemInputFieldNameTypeResolvers';
    public const UPDATE_MEDIA_ITEM_INPUT_FIELD_NAME_TYPE_RESOLVERS = __CLASS__ . ':updateMediaItemInputFieldNameTypeResolvers';
    public const CREATE_OR_UPDATE_MEDIA_ITEM_INPUT_FIELD_DESCRIPTION = __CLASS__ . ':createOrUpdateMediaItemInputFieldDescription';
    public const CREATE_MEDIA_ITEM_INPUT_FIELD_DESCRIPTION = __CLASS__ . ':createMediaItemInputFieldDescription';
    public const UPDATE_MEDIA_ITEM_INPUT_FIELD_DESCRIPTION = __CLASS__ . ':updateMediaItemInputFieldDescription';
    public const CREATE_OR_UPDATE_MEDIA_ITEM_INPUT_FIELD_TYPE_MODIFIERS = __CLASS__ . ':createOrUpdateMediaItemInputFieldTypeModifiers';
    public const CREATE_MEDIA_ITEM_INPUT_FIELD_TYPE_MODIFIERS = __CLASS__ . ':createMediaItemInputFieldTypeModifiers';
    public const UPDATE_MEDIA_ITEM_INPUT_FIELD_TYPE_MODIFIERS = __CLASS__ . ':updateMediaItemInputFieldTypeModifiers';
    public const ERROR_PAYLOAD = __CLASS__ . ':errorPayload';
}
