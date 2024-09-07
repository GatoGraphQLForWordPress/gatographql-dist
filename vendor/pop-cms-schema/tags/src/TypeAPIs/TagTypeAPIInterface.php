<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\TypeAPIs;

use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTypeAPIInterface;
/** @internal */
interface TagTypeAPIInterface extends TaxonomyTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type Tag
     */
    public function isInstanceOfTagType(object $object) : bool;
    /**
     * @return string|int
     */
    public function getTagID(object $tag);
    /**
     * @param string|int $tagID
     */
    public function getTag($tagID) : ?object;
    /**
     * @param int|string $id
     */
    public function tagExists($id) : bool;
    /**
     * @return array<string|int>|object[]
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getTags(array $query, array $options = []) : array;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getTagCount(array $query = [], array $options = []) : int;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     * @return array<string|int>|object[]
     * @param string|int|object $customPostObjectOrID
     */
    public function getCustomPostTags($customPostObjectOrID, array $query = [], array $options = []) : array;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     * @param string|int|object $customPostObjectOrID
     */
    public function getCustomPostTagCount($customPostObjectOrID, array $query = [], array $options = []) : ?int;
}
