<?php

declare(strict_types=1);

namespace PoPCMSSchema\TagsWP\TypeAPIs;

use PoPCMSSchema\Tags\TypeAPIs\UniversalTagTypeAPIInterface;
use PoPCMSSchema\TaxonomiesWP\TypeAPIs\AbstractTaxonomyTypeAPI;
use WP_Term;

class UniversalTagTypeAPI extends AbstractTaxonomyTypeAPI implements UniversalTagTypeAPIInterface
{
    protected function isHierarchical(): bool
    {
        return false;
    }

    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagName($tagObjectOrID): ?string
    {
        /** @var string|int|WP_Term $tagObjectOrID */
        return $this->getTaxonomyTermName($tagObjectOrID);
    }

    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagURL($tagObjectOrID): ?string
    {
        /** @var string|int|WP_Term $tagObjectOrID */
        return $this->getTaxonomyTermURL($tagObjectOrID);
    }

    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagURLPath($tagObjectOrID): ?string
    {
        /** @var string|int|WP_Term $tagObjectOrID */
        return $this->getTaxonomyTermURLPath($tagObjectOrID);
    }

    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagSlug($tagObjectOrID): ?string
    {
        /** @var string|int|WP_Term $tagObjectOrID */
        return $this->getTaxonomyTermSlug($tagObjectOrID);
    }

    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagDescription($tagObjectOrID): ?string
    {
        /** @var string|int|WP_Term $tagObjectOrID */
        return $this->getTaxonomyTermDescription($tagObjectOrID);
    }

    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagItemCount($tagObjectOrID): ?int
    {
        /** @var string|int|WP_Term $tagObjectOrID */
        return $this->getTaxonomyTermItemCount($tagObjectOrID);
    }
}
