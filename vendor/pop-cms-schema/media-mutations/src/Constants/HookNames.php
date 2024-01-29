<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\Constants;

/** @internal */
class HookNames
{
    public const CREATE_MEDIA_ITEM = __CLASS__ . ':createMediaItem';
    public const VALIDATE_CREATE_MEDIA_ITEM = __CLASS__ . ':validateCreateMediaItem';
    public const GET_CREATE_MEDIA_ITEM_DATA = __CLASS__ . ':getCreateMediaItemData';
    public const CREATE_MEDIA_ITEM_INPUT_FIELD_NAME_TYPE_RESOLVERS = __CLASS__ . ':createMediaItemInputFieldNameTypeResolvers';
    public const CREATE_MEDIA_ITEM_INPUT_FIELD_DESCRIPTION = __CLASS__ . ':createMediaItemInputFieldDescription';
    public const CREATE_MEDIA_ITEM_INPUT_FIELD_TYPE_MODIFIERS = __CLASS__ . ':createMediaItemInputFieldTypeModifiers';
    public const ERROR_PAYLOAD = __CLASS__ . ':errorPayload';
}
