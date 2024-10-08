<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeAPIs;

use PoPCMSSchema\CustomPostMutations\Exception\CustomPostCRUDMutationException;
/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 * @internal
 */
interface CustomPostTypeMutationAPIInterface
{
    /**
     * @param array<string,mixed> $data
     * @return string|int the ID of the created custom post
     * @throws CustomPostCRUDMutationException If there was an error (eg: some Custom Post creation validation failed)
     */
    public function createCustomPost(array $data);
    /**
     * @param array<string,mixed> $data
     * @return string|int the ID of the updated custom post
     * @throws CustomPostCRUDMutationException If there was an error (eg: Custom Post does not exist)
     */
    public function updateCustomPost(array $data);
    /**
     * @param string|int $userID
     * @param string|int $customPostID
     */
    public function canUserEditCustomPost($userID, $customPostID) : bool;
    /**
     * @param string|int $userID
     */
    public function canUserEditCustomPostType($userID, string $customPostType) : bool;
}
