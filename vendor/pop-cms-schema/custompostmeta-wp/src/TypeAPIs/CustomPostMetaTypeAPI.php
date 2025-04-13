<?php

declare(strict_types=1);

namespace PoPCMSSchema\CustomPostMetaWP\TypeAPIs;

use PoPCMSSchema\CustomPostMeta\TypeAPIs\AbstractCustomPostMetaTypeAPI;
use WP_Post;

class CustomPostMetaTypeAPI extends AbstractCustomPostMetaTypeAPI
{
    /**
     * If the key is non-existent, return `null`.
     * Otherwise, return the value.
     * @param string|int|object $customPostObjectOrID
     * @return mixed
     */
    protected function doGetCustomPostMeta($customPostObjectOrID, string $key, bool $single = false)
    {
        if (is_object($customPostObjectOrID)) {
            /** @var WP_Post */
            $customPost = $customPostObjectOrID;
            $customPostID = $customPost->ID;
        } else {
            $customPostID = $customPostObjectOrID;
        }

        // This function does not differentiate between a stored empty value,
        // and a non-existing key! So if empty, treat it as non-existent and return null
        $value = \get_post_meta((int)$customPostID, $key, $single);
        if (($single && $value === '') || (!$single && $value === [])) {
            return null;
        }
        return $value;
    }

    /**
     * @return array<string,mixed>
     * @param string|int|object $customPostObjectOrID
     */
    public function getAllCustomPostMeta($customPostObjectOrID): array
    {
        if (is_object($customPostObjectOrID)) {
            /** @var WP_Post */
            $customPost = $customPostObjectOrID;
            $customPostID = $customPost->ID;
        } else {
            $customPostID = $customPostObjectOrID;
        }

        return array_map(
            /**
             * @param mixed[] $items
             * @return mixed[]
             */
            function (array $items): array {
                return array_map(
                    \Closure::fromCallable('maybe_unserialize'),
                    $items
                );
            },
            \get_post_meta((int)$customPostID) ?? []
        );
    }

    /**
     * @return string[]
     * @param string|int|object $customPostObjectOrID
     */
    public function getCustomPostMetaKeys($customPostObjectOrID): array
    {
        return array_keys($this->getAllCustomPostMeta($customPostObjectOrID));
    }
}
