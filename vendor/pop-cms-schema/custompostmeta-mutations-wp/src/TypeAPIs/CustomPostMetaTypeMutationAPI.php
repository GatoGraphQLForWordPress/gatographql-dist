<?php

declare(strict_types=1);

namespace PoPCMSSchema\CustomPostMetaMutationsWP\TypeAPIs;

use PoPCMSSchema\CustomPostMetaMutations\TypeAPIs\AbstractCustomPostMetaTypeMutationAPI;
use WP_Error;

use function add_post_meta;
use function delete_post_meta;
use function update_post_meta;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class CustomPostMetaTypeMutationAPI extends AbstractCustomPostMetaTypeMutationAPI
{
    /**
     * @param string|int $entityID
     * @return int|false|\WP_Error
     * @param mixed $value
     */
    protected function executeAddEntityMeta($entityID, string $key, $value, bool $single = false)
    {
        return add_post_meta((int) $entityID, $key, $value, $single);
    }

    /**
     * @param string|int $entityID
     * @return int|bool|\WP_Error
     * @param mixed $value
     * @param mixed $prevValue
     */
    protected function executeUpdateEntityMeta($entityID, string $key, $value, $prevValue = null)
    {
        return update_post_meta((int) $entityID, $key, $value, $prevValue ?? '');
    }

    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function executeDeleteEntityMeta($entityID, string $key, $value = null): bool
    {
        return delete_post_meta((int) $entityID, $key, $value ?? '');
    }
}
