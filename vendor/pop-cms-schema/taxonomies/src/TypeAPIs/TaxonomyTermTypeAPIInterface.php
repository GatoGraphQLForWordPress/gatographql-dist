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
    public function taxonomyTermExists($id) : bool;
}
