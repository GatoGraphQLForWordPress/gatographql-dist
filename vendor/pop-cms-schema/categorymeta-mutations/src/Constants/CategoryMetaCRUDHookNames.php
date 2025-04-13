<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\Constants;

/** @internal */
class CategoryMetaCRUDHookNames
{
    public const VALIDATE_SET_META = __CLASS__ . ':validate-set-meta';
    public const VALIDATE_ADD_META = __CLASS__ . ':validate-add-meta';
    public const VALIDATE_UPDATE_META = __CLASS__ . ':validate-update-meta';
    public const VALIDATE_DELETE_META = __CLASS__ . ':validate-delete-meta';
    public const EXECUTE_SET_META = __CLASS__ . ':execute-set-meta';
    public const EXECUTE_ADD_META = __CLASS__ . ':execute-add-meta';
    public const EXECUTE_UPDATE_META = __CLASS__ . ':execute-update-meta';
    public const EXECUTE_DELETE_META = __CLASS__ . ':execute-delete-meta';
    public const GET_SET_META_DATA = __CLASS__ . ':get-set-meta-data';
    public const GET_ADD_META_DATA = __CLASS__ . ':get-add-meta-data';
    public const GET_UPDATE_META_DATA = __CLASS__ . ':get-update-meta-data';
    public const GET_DELETE_META_DATA = __CLASS__ . ':get-delete-meta-data';
    public const ERROR_PAYLOAD = __CLASS__ . ':error-payload';
}
