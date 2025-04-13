<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeAPIs;

use PoPCMSSchema\CustomPostMetaMutations\Exception\CustomPostMetaCRUDMutationException;
use PoPCMSSchema\CustomPostMetaMutations\TypeAPIs\CustomPostMetaTypeMutationAPIInterface;
use PoPCMSSchema\MetaMutations\TypeAPIs\AbstractEntityMetaTypeMutationAPI;
/** @internal */
abstract class AbstractCustomPostMetaTypeMutationAPI extends AbstractEntityMetaTypeMutationAPI implements CustomPostMetaTypeMutationAPIInterface
{
    /**
     * @phpstan-return class-string<CustomPostMetaCRUDMutationException>
     */
    protected function getEntityMetaCRUDMutationExceptionClass() : string
    {
        return CustomPostMetaCRUDMutationException::class;
    }
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws CustomPostMetaCRUDMutationException If there was an error
     * @param string|int $customPostID
     */
    public function setCustomPostMeta($customPostID, array $entries) : void
    {
        $this->setEntityMeta($customPostID, $entries);
    }
    /**
     * @return int The term_id of the newly created term
     * @throws CustomPostMetaCRUDMutationException If there was an error
     * @param string|int $customPostID
     * @param mixed $value
     */
    public function addCustomPostMeta($customPostID, string $key, $value, bool $single = \false) : int
    {
        return $this->addEntityMeta($customPostID, $key, $value, $single);
    }
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     * @param string|int $customPostID
     * @param mixed $value
     * @param mixed $prevValue
     */
    public function updateCustomPostMeta($customPostID, string $key, $value, $prevValue = null)
    {
        return $this->updateEntityMeta($customPostID, $key, $value, $prevValue);
    }
    /**
     * @throws CustomPostMetaCRUDMutationException If there was an error (eg: custom post does not exist)
     * @param string|int $customPostID
     * @param mixed $value
     */
    public function deleteCustomPostMeta($customPostID, string $key, $value = null) : void
    {
        $this->deleteEntityMeta($customPostID, $key, $value);
    }
}
