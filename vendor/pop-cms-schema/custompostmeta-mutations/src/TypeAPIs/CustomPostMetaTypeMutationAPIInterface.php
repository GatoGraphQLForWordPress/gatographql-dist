<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeAPIs;

use PoPCMSSchema\MetaMutations\TypeAPIs\EntityMetaTypeMutationAPIInterface;
use PoPCMSSchema\CustomPostMetaMutations\Exception\CustomPostMetaCRUDMutationException;
/** @internal */
interface CustomPostMetaTypeMutationAPIInterface extends EntityMetaTypeMutationAPIInterface
{
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws CustomPostMetaCRUDMutationException If there was an error
     * @param string|int $customPostID
     */
    public function setCustomPostMeta($customPostID, array $entries) : void;
    /**
     * @return int The term_id of the newly created term
     * @throws CustomPostMetaCRUDMutationException If there was an error
     * @param string|int $customPostID
     * @param mixed $value
     */
    public function addCustomPostMeta($customPostID, string $key, $value, bool $single = \false) : int;
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     * @param string|int $customPostID
     * @param mixed $value
     * @param mixed $prevValue
     */
    public function updateCustomPostMeta($customPostID, string $key, $value, $prevValue = null);
    /**
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     * @param string|int $customPostID
     * @param mixed $value
     */
    public function deleteCustomPostMeta($customPostID, string $key, $value = null) : void;
}
