<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeAPIs;

use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTypeAPIInterface;
/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 * @internal
 */
interface CategoryTypeAPIInterface extends TaxonomyTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type Category
     */
    public function isInstanceOfCategoryType(object $object) : bool;
    /**
     * @return string|int
     */
    public function getCategoryID(object $cat);
    /**
     * @param string|int $categoryID
     */
    public function getCategory($categoryID) : ?object;
    /**
     * @param int|string $id
     */
    public function categoryExists($id) : bool;
    /**
     * @return array<string|int>|object[]
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getCategories(array $query, array $options = []) : array;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    public function getCategoryCount(array $query, array $options = []) : int;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     * @return array<string|int>|object[]
     * @param string|int|object $customPostObjectOrID
     */
    public function getCustomPostCategories($customPostObjectOrID, array $query = [], array $options = []) : array;
    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     * @param string|int|object $customPostObjectOrID
     */
    public function getCustomPostCategoryCount($customPostObjectOrID, array $query, array $options = []) : ?int;
}
