<?php

declare(strict_types=1);

namespace PoPCMSSchema\UserMetaMutationsWP\TypeAPIs;

use PoPCMSSchema\UserMetaMutations\TypeAPIs\AbstractUserMetaTypeMutationAPI;
use WP_Error;

use function add_user_meta;
use function delete_user_meta;
use function update_user_meta;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class UserMetaTypeMutationAPI extends AbstractUserMetaTypeMutationAPI
{
    /**
     * @param string|int $entityID
     * @return int|false|\WP_Error
     * @param mixed $value
     */
    protected function executeAddEntityMeta($entityID, string $key, $value, bool $single = false)
    {
        return add_user_meta((int) $entityID, $key, $value, $single);
    }

    /**
     * @param string|int $entityID
     * @return int|bool|\WP_Error
     * @param mixed $value
     * @param mixed $prevValue
     */
    protected function executeUpdateEntityMeta($entityID, string $key, $value, $prevValue = null)
    {
        return update_user_meta((int) $entityID, $key, $value, $prevValue ?? '');
    }

    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function executeDeleteEntityMeta($entityID, string $key, $value = null): bool
    {
        return delete_user_meta((int) $entityID, $key, $value ?? '');
    }
}
