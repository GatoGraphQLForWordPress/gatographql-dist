<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\Constants;

class HookNames
{
    public const VALIDATE_CREATE_OR_UPDATE = __CLASS__ . ':validate-create-or-update';
    public const VALIDATE_CREATE = __CLASS__ . ':validate-create';
    public const VALIDATE_UPDATE = __CLASS__ . ':validate-update';
    public const EXECUTE_CREATE_OR_UPDATE = __CLASS__ . ':execute-create-or-update';
    public const EXECUTE_CREATE = __CLASS__ . ':execute-create';
    public const EXECUTE_UPDATE = __CLASS__ . ':execute-update';
    public const GET_CREATE_OR_UPDATE_DATA = __CLASS__ . ':get-create-or-update-data';
    public const GET_CREATE_DATA = __CLASS__ . ':get-create-data';
    public const GET_UPDATE_DATA = __CLASS__ . ':get-update-data';
    public const ERROR_PAYLOAD = __CLASS__ . ':error-payload';
}
