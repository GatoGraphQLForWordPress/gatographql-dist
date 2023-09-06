<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\TypeAPIs;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
interface CommentTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type Comment
     */
    public function isInstanceOfCommentType(object $object) : bool;
    /**
     * @return array<string|int>|object[]
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getComments(array $query, array $options = []) : array;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getCommentCount(array $query, array $options = []) : int;
    /**
     * @param string|int $comment_id
     */
    public function getComment($comment_id) : ?object;
    /**
     * @param string|int $post_id
     */
    public function getCommentNumber($post_id) : int;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function areCommentsOpen($customPostObjectOrID) : bool;
    public function getCommentContent(object $comment) : string;
    public function getCommentRawContent(object $comment) : string;
    /**
     * @return int|string
     */
    public function getCommentPostID(object $comment);
    public function isCommentApproved(object $comment) : bool;
    public function getCommentType(object $comment) : string;
    public function getCommentStatus(object $comment) : string;
    /**
     * @return int|string|null
     */
    public function getCommentParent(object $comment);
    public function getCommentDate(object $comment, bool $gmt = \false) : string;
    /**
     * @return string|int
     */
    public function getCommentID(object $comment);
    public function getCommentAuthorName(object $comment) : string;
    public function getCommentAuthorEmail(object $comment) : string;
    public function getCommentAuthorURL(object $comment) : ?string;
    public function doesCustomPostTypeSupportComments(string $customPostType) : bool;
}
