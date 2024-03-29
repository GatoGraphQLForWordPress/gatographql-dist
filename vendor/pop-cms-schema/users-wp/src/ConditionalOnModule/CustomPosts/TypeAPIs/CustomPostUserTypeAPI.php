<?php

declare(strict_types=1);

namespace PoPCMSSchema\UsersWP\ConditionalOnModule\CustomPosts\TypeAPIs;

use PoPCMSSchema\Users\ConditionalOnModule\CustomPosts\TypeAPIs\CustomPostUserTypeAPIInterface;
use WP_Post;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class CustomPostUserTypeAPI implements CustomPostUserTypeAPIInterface
{
    /**
     * @param string|int|object $customPostObjectOrID
     * @return string|int|null
     */
    public function getAuthorID($customPostObjectOrID)
    {
        if (is_object($customPostObjectOrID)) {
            /** @var WP_Post */
            $customPost = $customPostObjectOrID;
            return $customPost->post_author;
        }

        $customPostID = $customPostObjectOrID;
        /** @var WP_Post|null */
        $customPost = \get_post((int)$customPostID);
        if ($customPost === null) {
            return null;
        }
        return $customPost->post_author;
    }
}
