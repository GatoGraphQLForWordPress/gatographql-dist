<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\TypeAPIs;

use PoPCMSSchema\CategoryMetaMutations\Exception\CategoryTermMetaCRUDMutationException;
use PoPCMSSchema\TaxonomyMetaMutations\TypeAPIs\TaxonomyMetaTypeMutationAPIInterface;
/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 * @internal
 */
interface CategoryMetaTypeMutationAPIInterface extends TaxonomyMetaTypeMutationAPIInterface
{
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws CategoryTermMetaCRUDMutationException If there was an error
     * @param string|int $taxonomyTermID
     */
    public function setCategoryTermMeta($taxonomyTermID, array $entries) : void;
    /**
     * @return int The term_id of the newly created term
     * @throws CategoryTermMetaCRUDMutationException If there was an error
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function addCategoryTermMeta($taxonomyTermID, string $key, $value, bool $single = \false) : int;
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws CategoryTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function updateCategoryTermMeta($taxonomyTermID, string $key, $value);
    /**
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function deleteCategoryTermMeta($taxonomyTermID, string $key, $value = null) : void;
}
