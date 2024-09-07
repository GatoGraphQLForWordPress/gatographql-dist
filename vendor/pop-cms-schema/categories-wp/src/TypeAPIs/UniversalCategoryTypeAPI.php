<?php

declare(strict_types=1);

namespace PoPCMSSchema\CategoriesWP\TypeAPIs;

use PoPCMSSchema\Categories\TypeAPIs\UniversalCategoryTypeAPIInterface;
use PoPCMSSchema\TaxonomiesWP\TypeAPIs\AbstractTaxonomyTypeAPI;
use WP_Term;

class UniversalCategoryTypeAPI extends AbstractTaxonomyTypeAPI implements UniversalCategoryTypeAPIInterface
{
    protected function isHierarchical(): bool
    {
        return true;
    }

    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryURL($catObjectOrID): ?string
    {
        /** @var string|int|WP_Term $catObjectOrID */
        return $this->getTaxonomyTermURL($catObjectOrID);
    }

    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryURLPath($catObjectOrID): ?string
    {
        /** @var string|int|WP_Term $catObjectOrID */
        return $this->getTaxonomyTermURLPath($catObjectOrID);
    }

    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategorySlug($catObjectOrID): ?string
    {
        /** @var string|int|WP_Term $catObjectOrID */
        return $this->getTaxonomyTermSlug($catObjectOrID);
    }

    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategorySlugPath($catObjectOrID): ?string
    {
        /** @var string|int|WP_Term $catObjectOrID */
        return $this->getTaxonomyTermSlugPath($catObjectOrID, '');
    }

    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryName($catObjectOrID): ?string
    {
        /** @var string|int|WP_Term $catObjectOrID */
        return $this->getTaxonomyTermName($catObjectOrID);
    }

    /**
     * @param string|int|object $catObjectOrID
     * @return string|int|null
     */
    public function getCategoryParentID($catObjectOrID)
    {
        /** @var string|int|WP_Term $catObjectOrID */
        return $this->getTaxonomyTermParentID($catObjectOrID);
    }

    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryDescription($catObjectOrID): ?string
    {
        /** @var string|int|WP_Term $catObjectOrID */
        return $this->getTaxonomyTermDescription($catObjectOrID);
    }

    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryItemCount($catObjectOrID): ?int
    {
        /** @var string|int|WP_Term $catObjectOrID */
        return $this->getTaxonomyTermItemCount($catObjectOrID);
    }
}
