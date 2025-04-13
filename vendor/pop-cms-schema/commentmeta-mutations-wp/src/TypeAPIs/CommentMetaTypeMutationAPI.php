<?php

declare(strict_types=1);

namespace PoPCMSSchema\CommentMetaMutationsWP\TypeAPIs;

use PoPCMSSchema\CommentMetaMutations\TypeAPIs\AbstractCommentMetaTypeMutationAPI;
use WP_Error;

use function add_comment_meta;
use function delete_comment_meta;
use function update_comment_meta;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class CommentMetaTypeMutationAPI extends AbstractCommentMetaTypeMutationAPI
{
    /**
     * @param string|int $entityID
     * @return int|false|\WP_Error
     * @param mixed $value
     */
    protected function executeAddEntityMeta($entityID, string $key, $value, bool $single = false)
    {
        return add_comment_meta((int) $entityID, $key, $value, $single);
    }

    /**
     * @param string|int $entityID
     * @return int|bool|\WP_Error
     * @param mixed $value
     * @param mixed $prevValue
     */
    protected function executeUpdateEntityMeta($entityID, string $key, $value, $prevValue = null)
    {
        return update_comment_meta((int) $entityID, $key, $value, $prevValue ?? '');
    }

    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function executeDeleteEntityMeta($entityID, string $key, $value = null): bool
    {
        return delete_comment_meta((int) $entityID, $key, $value ?? '');
    }
}
