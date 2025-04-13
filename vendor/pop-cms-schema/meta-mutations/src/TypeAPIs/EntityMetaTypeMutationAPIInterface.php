<?php

declare (strict_types=1);
namespace PoPCMSSchema\MetaMutations\TypeAPIs;

use PoPCMSSchema\MetaMutations\Exception\EntityMetaCRUDMutationException;
/** @internal */
interface EntityMetaTypeMutationAPIInterface
{
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws EntityMetaCRUDMutationException If there was an error
     * @param string|int $entityID
     */
    public function setEntityMeta($entityID, array $entries) : void;
    /**
     * @return int The term_id of the newly created term
     * @throws EntityMetaCRUDMutationException If there was an error
     * @param string|int $entityID
     * @param mixed $value
     */
    public function addEntityMeta($entityID, string $key, $value, bool $single = \false) : int;
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws EntityMetaCRUDMutationException If there was an error (eg: taxonomy term does not exist)
     * @param string|int $entityID
     * @param mixed $value
     */
    public function updateEntityMeta($entityID, string $key, $value);
    /**
     * @throws EntityMetaCRUDMutationException If there was an error (eg: taxonomy does not exist)
     * @param string|int $entityID
     * @param mixed $value
     */
    public function deleteEntityMeta($entityID, string $key, $value = null) : void;
}
