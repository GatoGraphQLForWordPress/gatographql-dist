<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\TypeAPIs;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
interface CustomPostTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type (Generic)CustomPost
     */
    public function isInstanceOfCustomPostType(object $object) : bool;
    /**
     * Indicate if an post with provided ID exists
     * @param int|string $id
     */
    public function customPostExists($id) : bool;
    /**
     * Return the object's ID
     * @return string|int
     */
    public function getID(object $customPostObject);
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getContent($customPostObjectOrID) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getRawContent($customPostObjectOrID) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getPermalink($customPostObjectOrID) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getPermalinkPath($customPostObjectOrID) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getSlug($customPostObjectOrID) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getStatus($customPostObjectOrID) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getPublishedDate($customPostObjectOrID, bool $gmt = \false) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getModifiedDate($customPostObjectOrID, bool $gmt = \false) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getTitle($customPostObjectOrID) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getRawTitle($customPostObjectOrID) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getExcerpt($customPostObjectOrID) : ?string;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getRawExcerpt($customPostObjectOrID) : ?string;
    /**
     * Get the custom post with provided ID or, if it doesn't exist, null
     * @param int|string $id
     */
    public function getCustomPost($id) : ?object;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function getCustomPostType($customPostObjectOrID) : ?string;
    /**
     * If param "status" in $query is not passed, it defaults to "publish"
     *
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     * @return array<string|int>|object[]
     */
    public function getCustomPosts(array $query, array $options = []) : array;
    /**
     * If param "status" in $query is not passed, it defaults to "publish"
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getCustomPostCount(array $query, array $options = []) : int;
    /**
     * @return string[]
     * @param array<string,mixed> $query
     */
    public function getCustomPostTypes(array $query = array()) : array;
}
