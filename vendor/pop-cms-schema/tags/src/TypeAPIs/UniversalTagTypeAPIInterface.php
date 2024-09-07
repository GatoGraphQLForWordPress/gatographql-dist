<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\TypeAPIs;

use PoPCMSSchema\Taxonomies\TypeAPIs\TaxonomyTypeAPIInterface;
/** @internal */
interface UniversalTagTypeAPIInterface extends TaxonomyTypeAPIInterface
{
    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagURL($tagObjectOrID) : ?string;
    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagURLPath($tagObjectOrID) : ?string;
    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagName($tagObjectOrID) : ?string;
    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagSlug($tagObjectOrID) : ?string;
    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagDescription($tagObjectOrID) : ?string;
    /**
     * @param string|int|object $tagObjectOrID
     */
    public function getTagItemCount($tagObjectOrID) : ?int;
}
