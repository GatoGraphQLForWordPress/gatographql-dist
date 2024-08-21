<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeAPIs;

use PoPCMSSchema\CategoryMutations\Exception\CategoryTermCRUDMutationException;
use PoPCMSSchema\TaxonomyMutations\TypeAPIs\TaxonomyTypeMutationAPIInterface;
/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 * @internal
 */
interface CategoryTypeMutationAPIInterface extends TaxonomyTypeMutationAPIInterface
{
    /**
     * @param array<string,mixed> $data
     * @return string|int the ID of the created category
     * @throws CategoryTermCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     */
    public function createCategoryTerm(string $taxonomyName, array $data);
    /**
     * @param array<string,mixed> $data
     * @return string|int the ID of the updated category
     * @throws CategoryTermCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     */
    public function updateCategoryTerm($taxonomyTermID, string $taxonomyName, array $data);
    /**
     * @param string|int $taxonomyTermID
     */
    public function deleteCategoryTerm($taxonomyTermID, string $taxonomyName) : bool;
}
