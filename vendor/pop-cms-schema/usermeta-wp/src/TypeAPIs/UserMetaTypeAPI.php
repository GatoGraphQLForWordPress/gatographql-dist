<?php

declare(strict_types=1);

namespace PoPCMSSchema\UserMetaWP\TypeAPIs;

use PoPCMSSchema\UserMeta\TypeAPIs\AbstractUserMetaTypeAPI;
use WP_User;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class UserMetaTypeAPI extends AbstractUserMetaTypeAPI
{
    /**
     * If the key is non-existent, return `null`.
     * Otherwise, return the value.
     * @param string|int|object $userObjectOrID
     * @return mixed
     */
    protected function doGetUserMeta($userObjectOrID, string $key, bool $single = false)
    {
        if (is_object($userObjectOrID)) {
            /** @var WP_User */
            $user = $userObjectOrID;
            $userID = $user->ID;
        } else {
            $userID = $userObjectOrID;
        }

        /**
         * This function does not differentiate between a stored empty value,
         * and a non-existing key!
         *
         * So if empty, treat it as non-existent and return null.
         */
        $value = \get_user_meta((int)$userID, $key, $single);
        if (($single && $value === '') || (!$single && $value === [])) {
            return null;
        }
        return $value;
    }

    /**
     * @return array<string,mixed>
     * @param string|int|object $userObjectOrID
     */
    public function getAllUserMeta($userObjectOrID): array
    {
        if (is_object($userObjectOrID)) {
            /** @var WP_User */
            $user = $userObjectOrID;
            $userID = $user->ID;
        } else {
            $userID = $userObjectOrID;
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
            \get_user_meta((int)$userID) ?? []
        );
    }

    /**
     * @return string[]
     * @param string|int|object $userObjectOrID
     */
    public function getUserMetaKeys($userObjectOrID): array
    {
        return array_keys($this->getAllUserMeta($userObjectOrID));
    }
}
