<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMedia\TypeAPIs;

/** @internal */
interface CustomPostMediaTypeAPIInterface
{
    public function doesCustomPostTypeSupportFeaturedImage(string $customPostType) : bool;
    /**
     * @param string|int|object $customPostObjectOrID
     */
    public function hasCustomPostThumbnail($customPostObjectOrID) : bool;
    /**
     * @param string|int|object $customPostObjectOrID
     * @return string|int|null
     */
    public function getCustomPostThumbnailID($customPostObjectOrID);
}
