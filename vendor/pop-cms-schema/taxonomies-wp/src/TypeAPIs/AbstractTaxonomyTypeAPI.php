<?php

declare(strict_types=1);

namespace PoPCMSSchema\TaxonomiesWP\TypeAPIs;

use PoPCMSSchema\SchemaCommons\CMS\CMSHelperServiceInterface;
use PoPCMSSchema\SchemaCommons\DataLoading\ReturnTypes;
use PoPCMSSchema\Taxonomies\Constants\TaxonomyOrderBy;
use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTypeAPIInterface;
use PoPSchema\SchemaCommons\Constants\QueryOptions;
use PoP\Root\App;
use PoP\Root\Services\AbstractBasicService;
use WP_Error;
use WP_Post;
use WP_Term;

use function esc_sql;
use function get_term;
use function get_term_by;
use function get_term_link;
use function get_terms;
use function wp_get_post_terms;

abstract class AbstractTaxonomyTypeAPI extends AbstractBasicService implements TaxonomyTypeAPIInterface
{
    public const HOOK_QUERY = __CLASS__ . ':query';
    public const HOOK_ORDERBY_QUERY_ARG_VALUE = __CLASS__ . ':orderby-query-arg-value';

    /**
     * @var \PoPCMSSchema\SchemaCommons\CMS\CMSHelperServiceInterface|null
     */
    private $cmsHelperService;

    final protected function getCMSHelperService(): CMSHelperServiceInterface
    {
        if ($this->cmsHelperService === null) {
            /** @var CMSHelperServiceInterface */
            $cmsHelperService = $this->instanceManager->getInstance(CMSHelperServiceInterface::class);
            $this->cmsHelperService = $cmsHelperService;
        }
        return $this->cmsHelperService;
    }

    /**
     * @param string|int|\WP_Term $taxonomyTermObjectOrID
     */
    protected function getTaxonomyTermFromObjectOrID($taxonomyTermObjectOrID, ?string $taxonomy = null): ?WP_Term
    {
        if (is_object($taxonomyTermObjectOrID)) {
            /** @var WP_Term */
            return $taxonomyTermObjectOrID;
        }
        return $this->getTerm(
            $taxonomyTermObjectOrID,
            $taxonomy,
        );
    }

    /**
     * @param string|int $termObjectID
     */
    protected function getTerm($termObjectID, ?string $taxonomy = null): ?WP_Term
    {
        $term = get_term((int)$termObjectID, $taxonomy ?? '');
        if ($term instanceof WP_Error) {
            return null;
        }
        /** @var WP_Term */
        return $term;
    }

    /**
     * @param string|int|\WP_Post $customPostObjectOrID
     * @return string|int
     */
    protected function getCustomPostID($customPostObjectOrID)
    {
        if (is_object($customPostObjectOrID)) {
            /** @var WP_Post */
            $customPost = $customPostObjectOrID;
            return $customPost->ID;
        }
        return $customPostObjectOrID;
    }

    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     * @return array<string|int>|object[]|null
     * @param string|int|object $customPostObjectOrID
     */
    protected function getCustomPostTaxonomyTerms($customPostObjectOrID, array $query = [], array $options = []): ?array
    {
        /** @var string|int|WP_Post $customPostObjectOrID */
        $customPostID = $this->getCustomPostID($customPostObjectOrID);
        $query = $this->convertTaxonomyTermsQuery($query, $options);
        // If passing an empty array to `filter.ids`, return no results
        if ($this->isFilteringByEmptyArray($query)) {
            return [];
        }
        /** @var string|string[] */
        $taxonomyOrTaxonomies = $query['taxonomy'] ?? '';
        if (empty($taxonomyOrTaxonomies)) {
            return [];
        }
        $taxonomyTerms =  wp_get_post_terms(
            (int)$customPostID,
            $taxonomyOrTaxonomies,
            $query,
        );
        if ($taxonomyTerms instanceof WP_Error) {
            return null;
        }
        /** @var array<string|int>|object[] $taxonomyTerms */
        return $taxonomyTerms;
    }

    /**
     * Indicate if an empty array was passed to `filter.ids`
     *
     * @param array<string,mixed> $query
     */
    protected function isFilteringByEmptyArray(array $query): bool
    {
        return isset($query['include']) && ($query['include'] === '' || $query['include'] === []);
    }

    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     * @param string|int|\WP_Post $customPostObjectOrID
     */
    protected function getCustomPostTaxonomyTermCount(
        $customPostObjectOrID,
        array $query = [],
        array $options = []
    ): ?int {
        $customPostID = $this->getCustomPostID($customPostObjectOrID);

        // There is no direct way to calculate the total
        // (Documentation mentions to pass arg "count" => `true` to `wp_get_post_categories`,
        // but it doesn't work)
        // So execute a normal `wp_get_post_categories` retrieving all the IDs, and count them
        $options[QueryOptions::RETURN_TYPE] = ReturnTypes::IDS;
        $query = $this->convertTaxonomyTermsQuery($query, $options);

        // If passing an empty array to `filter.ids`, return no results
        if ($this->isFilteringByEmptyArray($query)) {
            return 0;
        }

        /** @var string|string[] */
        $taxonomyOrTaxonomies = $query['taxonomy'] ?? '';
        if (empty($taxonomyOrTaxonomies)) {
            return 0;
        }

        // All results, no offset
        $query['number'] = 0;
        unset($query['offset']);

        // Resolve and count
        $taxonomyTerms = wp_get_post_terms(
            (int)$customPostID,
            $taxonomyOrTaxonomies,
            $query,
        );
        if ($taxonomyTerms instanceof WP_Error) {
            return null;
        }

        /** @var int[] $taxonomyTerms */
        return count($taxonomyTerms);
    }

    /**
     * @return array<string,mixed>
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    protected function convertTaxonomyTermsQuery(array $query, array $options = []): array
    {
        if ($return_type = $options[QueryOptions::RETURN_TYPE] ?? null) {
            if ($return_type === ReturnTypes::IDS) {
                $query['fields'] = 'ids';
            } elseif ($return_type === ReturnTypes::NAMES) {
                $query['fields'] = 'names';
            } elseif ($return_type === ReturnTypes::SLUGS) {
                $query['fields'] = 'slugs';
            }
        }

        if (isset($query['taxonomy'])) {
            // Same param name, so do nothing
        } else {
            $queryDefaultTaxonomyOrTaxonomies = $this->getQueryDefaultTaxonomyOrTaxonomies();
            if ($queryDefaultTaxonomyOrTaxonomies !== null) {
                $query['taxonomy'] = $queryDefaultTaxonomyOrTaxonomies;
            }
        }

        if (isset($query['hide-empty'])) {
            $query['hide_empty'] = $query['hide-empty'];
            unset($query['hide-empty']);
        } else {
            // By default: do not hide empty categories
            $query['hide_empty'] = false;
        }

        // Convert the parameters
        if (isset($query['include']) && is_array($query['include'])) {
            // It can be an array or a string
            $query['include'] = implode(',', $query['include']);
        }
        if (isset($query['exclude-ids'])) {
            $query['exclude'] = $query['exclude-ids'];
            unset($query['exclude-ids']);
        }
        if (isset($query['order'])) {
            $query['order'] = esc_sql($query['order']);
        }
        if (isset($query['orderby'])) {
            // This param can either be a string or an array. Eg:
            // $query['orderby'] => array('date' => 'DESC', 'title' => 'ASC');
            $query['orderby'] = esc_sql($this->getOrderByQueryArgValue($query['orderby']));
        }
        if (isset($query['offset'])) {
            // Same param name, so do nothing
        }
        if (isset($query['limit'])) {
            $limit = (int) $query['limit'];
            // To bring all results, get_categories/get_tags needs "number => 0" instead of -1
            $query['number'] = ($limit === -1) ? 0 : $limit;
            unset($query['limit']);
        }
        if (isset($query['search'])) {
            // Same param name, so do nothing
        }
        if (isset($query['slugs'])) {
            $query['slug'] = $query['slugs'];
            unset($query['slugs']);
        }
        if (isset($query['slug'])) {
            // Same param name, so do nothing
        }

        /**
         * If parent-id is `null` then remove the parent!
         */
        if ($this->isHierarchical() && array_key_exists('parent-id', $query)) {
            $query['parent'] = $query['parent-id'];
            unset($query['parent-id']);
        }

        return App::applyFilters(
            self::HOOK_QUERY,
            $query,
            $options
        );
    }

    abstract protected function isHierarchical(): bool;

    /**
     * @return string|string[]|null
     */
    protected function getQueryDefaultTaxonomyOrTaxonomies()
    {
        return null;
    }

    protected function getOrderByQueryArgValue(string $orderBy): string
    {
        switch ($orderBy) {
            case TaxonomyOrderBy::NAME:
                $orderBy = 'name';
                break;
            case TaxonomyOrderBy::SLUG:
                $orderBy = 'slug';
                break;
            case TaxonomyOrderBy::ID:
                $orderBy = 'term_id';
                break;
            case TaxonomyOrderBy::PARENT:
                $orderBy = 'parent';
                break;
            case TaxonomyOrderBy::COUNT:
                $orderBy = 'count';
                break;
            case TaxonomyOrderBy::NONE:
                $orderBy = 'none';
                break;
            case TaxonomyOrderBy::INCLUDE:
                $orderBy = 'include';
                break;
            case TaxonomyOrderBy::SLUG__IN:
                $orderBy = 'slug__in';
                break;
            case TaxonomyOrderBy::DESCRIPTION:
                $orderBy = 'description';
                break;
            default:
                $orderBy = $orderBy;
                break;
        }
        return App::applyFilters(
            self::HOOK_ORDERBY_QUERY_ARG_VALUE,
            $orderBy
        );
    }

    /**
     * Indicates if the passed object is of type Taxonomy
     */
    protected function isInstanceOfTaxonomyTermType(object $object): bool
    {
        return $object instanceof WP_Term;
    }

    /**
     * @param string|int|\WP_Term $taxonomyTermObjectOrID
     */
    protected function getTaxonomyTermName($taxonomyTermObjectOrID, ?string $taxonomy = null): ?string
    {
        $taxonomyTerm = $this->getTaxonomyTermFromObjectOrID(
            $taxonomyTermObjectOrID,
            $taxonomy,
        );
        if ($taxonomyTerm === null) {
            return null;
        }
        return $taxonomyTerm->name;
    }

    protected function getTaxonomyTermByName(string $taxonomyTermName, ?string $taxonomy = null): ?WP_Term
    {
        $taxonomyTerm = get_term_by('name', $taxonomyTermName, $taxonomy ?? '');
        if (!($taxonomyTerm instanceof WP_Term)) {
            return null;
        }
        return $taxonomyTerm;
    }

    /**
     * @param array<string,mixed> $query
     * @param array<string,mixed> $options
     */
    protected function getTaxonomyCount(array $query = [], array $options = []): ?int
    {
        $query = $this->convertTaxonomyTermsQuery($query, $options);

        // If passing an empty array to `filter.ids`, return no results
        if ($this->isFilteringByEmptyArray($query)) {
            return 0;
        }

        // Indicate to return the count
        $query['count'] = true;
        $query['fields'] = 'count';

        // All results, no offset
        $query['number'] = 0;
        unset($query['offset']);

        // Execute query and return count
        $count = get_terms($query);

        if ($count instanceof WP_Error) {
            // An error happened
            return null;
        }

        // For some reason, the count may be returned as an array of 1 element!
        if (is_array($count) && count($count) === 1 && is_numeric($count[0])) {
            return (int) $count[0];
        }

        return (int) $count;
    }

    /**
     * @param string|int $taxonomyTermID
     */
    protected function getTaxonomyTerm($taxonomyTermID, ?string $taxonomy = null): ?WP_Term
    {
        $taxonomyTerm = get_term(
            (int)$taxonomyTermID,
            $taxonomy ?? '',
        );
        if (!($taxonomyTerm instanceof WP_Term)) {
            return null;
        }
        return $taxonomyTerm;
    }

    /**
     * @param string|int|\WP_Term $taxonomyTermObjectOrID
     */
    protected function getTaxonomyTermURL($taxonomyTermObjectOrID, ?string $taxonomy = null): ?string
    {
        $taxonomyTermLink = get_term_link(
            $taxonomyTermObjectOrID,
            $taxonomy ?? '',
        );
        if ($taxonomyTermLink instanceof WP_Error) {
            return null;
        }
        return $taxonomyTermLink;
    }

    /**
     * @param string|int|\WP_Term $taxonomyTermObjectOrID
     */
    protected function getTaxonomyTermURLPath($taxonomyTermObjectOrID, ?string $taxonomy = null): ?string
    {
        $url = $this->getTaxonomyTermURL(
            $taxonomyTermObjectOrID,
            $taxonomy
        );
        if ($url === null) {
            return null;
        }
        return $this->getCMSHelperService()->getLocalURLPath($url);
    }

    /**
     * @param string|int|\WP_Term $taxonomyTermObjectOrID
     */
    protected function getTaxonomyTermSlug($taxonomyTermObjectOrID, ?string $taxonomy = null): ?string
    {
        $taxonomyTerm = $this->getTaxonomyTermFromObjectOrID(
            $taxonomyTermObjectOrID,
            $taxonomy,
        );
        if ($taxonomyTerm === null) {
            return null;
        }
        /** @var WP_Term $taxonomyTerm */
        return $taxonomyTerm->slug;
    }

    /**
     * @param string|int|\WP_Term $taxonomyTermObjectOrID
     */
    protected function getTaxonomyTermSlugPath($taxonomyTermObjectOrID, string $taxonomy): ?string
    {
        $taxonomyTermID = is_object($taxonomyTermObjectOrID) ? $this->getTaxonomyTermID($taxonomyTermObjectOrID) : $taxonomyTermObjectOrID;
        $taxonomyTermParentsSlugPath = \get_term_parents_list(
            (int)$taxonomyTermID,
            $taxonomy,
            [
                'separator' => '/',
                'link' => false,
                'format' => 'slug',
            ]
        );
        if (
            $taxonomyTermParentsSlugPath === ''
            || $taxonomyTermParentsSlugPath instanceof WP_Error
        ) {
            return null;
        }
        return trim($taxonomyTermParentsSlugPath, '/');
    }

    /**
     * @param string|int|\WP_Term $taxonomyTermObjectOrID
     */
    protected function getTaxonomyTermDescription($taxonomyTermObjectOrID, ?string $taxonomy = null): ?string
    {
        $taxonomyTerm = $this->getTaxonomyTermFromObjectOrID(
            $taxonomyTermObjectOrID,
            $taxonomy,
        );
        if ($taxonomyTerm === null) {
            return null;
        }
        /** @var WP_Term $taxonomyTerm */
        return $taxonomyTerm->description;
    }

    /**
     * @param string|int|\WP_Term $taxonomyTermObjectOrID
     */
    protected function getTaxonomyTermItemCount($taxonomyTermObjectOrID, ?string $taxonomy = null): ?int
    {
        $taxonomyTerm = $this->getTaxonomyTermFromObjectOrID(
            $taxonomyTermObjectOrID,
            $taxonomy,
        );
        if ($taxonomyTerm === null) {
            return null;
        }
        /** @var WP_Term $taxonomyTerm */
        return $taxonomyTerm->count;
    }

    /**
     * @return string|int
     */
    protected function getTaxonomyTermID(WP_Term $taxonomyTerm)
    {
        return $taxonomyTerm->term_id;
    }

    /**
     * @param string|int|\WP_Term $taxonomyTermObjectOrID
     * @return string|int|null
     */
    protected function getTaxonomyTermParentID($taxonomyTermObjectOrID, ?string $taxonomy = null)
    {
        $taxonomyTerm = $this->getTaxonomyTermFromObjectOrID(
            $taxonomyTermObjectOrID,
            $taxonomy,
        );
        if ($taxonomyTerm === null) {
            return null;
        }
        // If it has no parent, it is assigned 0. In that case, return null
        if ($parent = $taxonomyTerm->parent) {
            return $parent;
        }
        return null;
    }
}
