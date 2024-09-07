<?php

declare (strict_types=1);
namespace PoPCMSSchema\Taxonomies\TypeAPIs;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 * @internal
 */
interface TaxonomyTermTypeAPIInterface
{
    /**
     * Retrieves the taxonomy name of the object ("post_tag", "category", etc)
     */
    public function getTermTaxonomyName(object $taxonomyTerm) : string;
    /**
     * @param int|string $id
     */
    public function taxonomyTermExists($id, ?string $taxonomy = null) : bool;
    /**
     * @return string|int|null
     */
    public function getTaxonomyTermID(string $taxonomyTermSlug, ?string $taxonomy = null);
    /**
     * @param int|string $taxonomyTermID
     */
    public function getTaxonomyTermTaxonomy($taxonomyTermID) : ?string;
    /**
     * @param int|string $taxonomyTermID
     */
    public function getTaxonomyTerm($taxonomyTermID, ?string $taxonomy = null) : ?object;
    /**
     * @param string|int $userID
     */
    public function canUserEditTaxonomy($userID, string $taxonomyName) : bool;
    /**
     * @param string|int $userID
     */
    public function canUserAssignTermsToTaxonomy($userID, string $taxonomyName) : bool;
    /**
     * @param string|int $userID
     * @param string|int $taxonomyTermID
     */
    public function canUserDeleteTaxonomyTerm($userID, $taxonomyTermID) : bool;
    public function getTaxonomy(string $taxonomyName) : ?object;
    public function taxonomyExists(string $taxonomyName) : bool;
    /**
     * @return string[]
     */
    public function getCustomPostTypeTaxonomyNames(string $customPostType) : array;
    public function isTaxonomyHierarchical(string $taxonomyName) : ?bool;
}
