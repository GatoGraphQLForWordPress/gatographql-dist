<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeAPIs;

use PoPCMSSchema\UserMetaMutations\Exception\UserMetaCRUDMutationException;
use PoPCMSSchema\UserMetaMutations\TypeAPIs\UserMetaTypeMutationAPIInterface;
use PoPCMSSchema\MetaMutations\TypeAPIs\AbstractEntityMetaTypeMutationAPI;
/** @internal */
abstract class AbstractUserMetaTypeMutationAPI extends AbstractEntityMetaTypeMutationAPI implements UserMetaTypeMutationAPIInterface
{
    /**
     * @phpstan-return class-string<UserMetaCRUDMutationException>
     */
    protected function getEntityMetaCRUDMutationExceptionClass() : string
    {
        return UserMetaCRUDMutationException::class;
    }
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws UserMetaCRUDMutationException If there was an error
     * @param string|int $userID
     */
    public function setUserMeta($userID, array $entries) : void
    {
        $this->setEntityMeta($userID, $entries);
    }
    /**
     * @return int The term_id of the newly created term
     * @throws UserMetaCRUDMutationException If there was an error
     * @param string|int $userID
     * @param mixed $value
     */
    public function addUserMeta($userID, string $key, $value, bool $single = \false) : int
    {
        return $this->addEntityMeta($userID, $key, $value, $single);
    }
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws UserMetaCRUDMutationException If there was an error (eg: user does not exist)
     * @param string|int $userID
     * @param mixed $value
     * @param mixed $prevValue
     */
    public function updateUserMeta($userID, string $key, $value, $prevValue = null)
    {
        return $this->updateEntityMeta($userID, $key, $value, $prevValue);
    }
    /**
     * @throws UserMetaCRUDMutationException If there was an error (eg: user does not exist)
     * @param string|int $userID
     * @param mixed $value
     */
    public function deleteUserMeta($userID, string $key, $value = null) : void
    {
        $this->deleteEntityMeta($userID, $key, $value);
    }
}
