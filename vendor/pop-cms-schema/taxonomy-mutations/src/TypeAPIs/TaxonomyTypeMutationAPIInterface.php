<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\TypeAPIs;

use PoPCMSSchema\TaxonomyMutations\Exception\TaxonomyTermCRUDMutationException;
/** @internal */
interface TaxonomyTypeMutationAPIInterface
{
    /**
     * @param array<string,mixed> $data
     * @return string|int the ID of the created taxonomy
     * @throws TaxonomyTermCRUDMutationException If there was an error (eg: some taxonomy term creation validation failed)
     */
    public function createTaxonomyTerm(string $taxonomyName, array $data);
    /**
     * @param array<string,mixed> $data
     * @return string|int the ID of the updated taxonomy
     * @throws TaxonomyTermCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $taxonomyTermID
     */
    public function updateTaxonomyTerm($taxonomyTermID, string $taxonomyName, array $data);
    /**
     * @return bool `true` if the operation successful, `false` if the term does not exist
     * @throws TaxonomyTermCRUDMutationException If there was an error (eg: taxonomy does not exist)
     * @param string|int $taxonomyTermID
     */
    public function deleteTaxonomyTerm($taxonomyTermID, string $taxonomyName) : bool;
}
