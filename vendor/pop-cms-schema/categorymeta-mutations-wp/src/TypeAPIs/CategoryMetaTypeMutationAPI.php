<?php

declare(strict_types=1);

namespace PoPCMSSchema\CategoryMetaMutationsWP\TypeAPIs;

use PoPCMSSchema\CategoryMetaMutations\Exception\CategoryTermMetaCRUDMutationException;
use PoPCMSSchema\CategoryMetaMutations\TypeAPIs\CategoryMetaTypeMutationAPIInterface;
use PoPCMSSchema\TaxonomyMetaMutationsWP\TypeAPIs\TaxonomyMetaTypeMutationAPI;
use PoPCMSSchema\TaxonomyMetaMutations\Exception\TaxonomyTermMetaCRUDMutationException;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class CategoryMetaTypeMutationAPI extends TaxonomyMetaTypeMutationAPI implements CategoryMetaTypeMutationAPIInterface
{
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws CategoryTermMetaCRUDMutationException If there was an error
     * @param string|int $taxonomyTermID
     */
    public function setCategoryTermMeta($taxonomyTermID, array $entries): void
    {
        $this->setTaxonomyTermMeta($taxonomyTermID, $entries);
    }

    /**
     * @return int The term_id of the newly created term
     * @throws CategoryTermMetaCRUDMutationException If there was an error
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function addCategoryTermMeta($taxonomyTermID, string $key, $value, bool $single = false): int
    {
        return $this->addTaxonomyTermMeta($taxonomyTermID, $key, $value, $single);
    }

    /**
     * @phpstan-return class-string<TaxonomyTermMetaCRUDMutationException>
     */
    protected function getTaxonomyTermMetaCRUDMutationExceptionClass(): string
    {
        return CategoryTermMetaCRUDMutationException::class;
    }

    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws CategoryTermMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     * @param mixed $value
     * @param mixed $prevValue
     */
    public function updateCategoryTermMeta($taxonomyTermID, string $key, $value, $prevValue = null)
    {
        return $this->updateTaxonomyTermMeta($taxonomyTermID, $key, $value, $prevValue);
    }

    /**
     * @param string|int $taxonomyTermID
     * @param mixed $value
     */
    public function deleteCategoryTermMeta($taxonomyTermID, string $key, $value = null): void
    {
        $this->deleteTaxonomyTermMeta($taxonomyTermID, $key, $value);
    }
}
