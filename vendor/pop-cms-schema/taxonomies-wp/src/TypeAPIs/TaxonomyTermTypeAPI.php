<?php

declare(strict_types=1);

namespace PoPCMSSchema\TaxonomiesWP\TypeAPIs;

use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTermTypeAPIInterface;
use PoP\Root\Services\BasicServiceTrait;
use WP_Error;
use WP_Taxonomy;
use WP_Term;

use function get_term;

class TaxonomyTermTypeAPI implements TaxonomyTermTypeAPIInterface
{
    use BasicServiceTrait;

    /**
     * Retrieves the taxonomy name of the object ("post_tag", "category", etc)
     */
    public function getTermTaxonomyName(object $taxonomyTerm): string
    {
        /** @var WP_Term $taxonomyTerm */
        return $taxonomyTerm->taxonomy;
    }
    /**
     * @param int|string $taxonomyTermIDOrSlug
     */
    public function taxonomyTermExists($taxonomyTermIDOrSlug, string $taxonomy = ''): bool
    {
        $taxonomyTermExists = term_exists($taxonomyTermIDOrSlug, $taxonomy);
        return $taxonomyTermExists !==  null;
    }
    /**
     * @param int|string $taxonomyTermIDOrSlug
     * @return string|int|null
     */
    public function getTaxonomyTermID($taxonomyTermIDOrSlug, string $taxonomy = '')
    {
        /** @var array<string,string|int>|string|int|null */
        $taxonomyTerm = term_exists($taxonomyTermIDOrSlug, $taxonomy);
        if ($taxonomyTerm === null) {
            return null;
        }
        if (is_array($taxonomyTerm)) {
            /** @var string|int */
            return $taxonomyTerm['term_id'];
        }
        /** @var string|int */
        return $taxonomyTerm;
    }

    /**
     * @param int|string $taxonomyTermID
     */
    public function getTaxonomyTermTaxonomy($taxonomyTermID): ?string
    {
        /** @var WP_Term|null */
        $taxonomyTerm = $this->getTaxonomyTerm($taxonomyTermID);
        if ($taxonomyTerm === null) {
            return null;
        }
        return $taxonomyTerm->taxonomy;
    }

    /**
     * @param int|string $taxonomyTermID
     */
    public function getTaxonomyTerm($taxonomyTermID, string $taxonomy = ''): ?object
    {
        /** @var WP_Term|WP_Error|null */
        $taxonomyTerm = get_term((int) $taxonomyTermID, $taxonomy);
        if ($taxonomyTerm instanceof WP_Error) {
            return null;
        }
        return $taxonomyTerm;
    }

    /**
     * @param string|int $userID
     */
    public function canUserEditTaxonomy($userID, string $taxonomyName): bool
    {
        /** @var WP_Taxonomy */
        $taxonomy = $this->getTaxonomy($taxonomyName);
        return isset($taxonomy->cap->edit_terms) && user_can((int) $userID, $taxonomy->cap->edit_terms);
    }

    /**
     * @param string|int $userID
     */
    public function canUserAssignTermsToTaxonomy($userID, string $taxonomyName): bool
    {
        /** @var WP_Taxonomy */
        $taxonomy = $this->getTaxonomy($taxonomyName);
        return isset($taxonomy->cap->assign_terms) && user_can((int) $userID, $taxonomy->cap->assign_terms);
    }

    /**
     * @param string|int $userID
     * @param string|int $taxonomyTermID
     */
    public function canUserDeleteTaxonomyTerm($userID, $taxonomyTermID): bool
    {
        return user_can((int) $userID, 'delete_term', $taxonomyTermID);
    }

    public function getTaxonomy(string $taxonomyName): ?object
    {
        $taxonomy = get_taxonomy($taxonomyName);
        if ($taxonomy === false) {
            return null;
        }
        return $taxonomy;
    }

    public function taxonomyExists(string $taxonomyName): bool
    {
        return $this->getTaxonomy($taxonomyName) !== null;
    }
}
