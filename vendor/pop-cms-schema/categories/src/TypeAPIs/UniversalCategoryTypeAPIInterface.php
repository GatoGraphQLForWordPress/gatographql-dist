<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeAPIs;

use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTypeAPIInterface;
/** @internal */
interface UniversalCategoryTypeAPIInterface extends TaxonomyTypeAPIInterface
{
    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategorySlug($catObjectOrID) : ?string;
    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategorySlugPath($catObjectOrID) : ?string;
    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryName($catObjectOrID) : ?string;
    /**
     * @param string|int|object $catObjectOrID
     * @return string|int|null
     */
    public function getCategoryParentID($catObjectOrID);
    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryURL($catObjectOrID) : ?string;
    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryURLPath($catObjectOrID) : ?string;
    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryDescription($catObjectOrID) : ?string;
    /**
     * @param string|int|object $catObjectOrID
     */
    public function getCategoryItemCount($catObjectOrID) : ?int;
}
