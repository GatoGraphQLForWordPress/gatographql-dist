<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\Constants;

/** @internal */
class CommentCRUDHookNames
{
    public const VALIDATE_ADD_COMMENT = __CLASS__ . ':validate-add-comment';
    public const EXECUTE_ADD_COMMENT = __CLASS__ . ':execute-add-comment';
    public const GET_ADD_COMMENT_DATA = __CLASS__ . ':get-add-comment-data';
    public const ERROR_PAYLOAD = __CLASS__ . ':error-payload';
}
