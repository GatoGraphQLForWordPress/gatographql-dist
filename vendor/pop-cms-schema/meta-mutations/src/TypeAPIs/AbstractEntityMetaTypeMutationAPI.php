<?php

declare (strict_types=1);
namespace PoPCMSSchema\MetaMutations\TypeAPIs;

use PoPCMSSchema\MetaMutations\Exception\EntityMetaCRUDMutationException;
use PoPCMSSchema\SchemaCommonsWP\TypeAPIs\TypeMutationAPITrait;
use PoP\ComponentModel\StaticHelpers\MethodHelpers;
use PoP\Root\Services\AbstractBasicService;
use GatoExternalPrefixByGatoGraphQL\WP_Error;
use stdClass;
/** @internal */
abstract class AbstractEntityMetaTypeMutationAPI extends AbstractBasicService implements \PoPCMSSchema\MetaMutations\TypeAPIs\EntityMetaTypeMutationAPIInterface
{
    use TypeMutationAPITrait;
    /**
     * @param int|bool|\WP_Error $result
     */
    protected function handleMaybeError($result) : void
    {
        if (!$result instanceof WP_Error) {
            return;
        }
        /** @var WP_Error */
        $wpError = $result;
        throw $this->getEntityMetaCRUDMutationException($wpError);
    }
    /**
     * @param \WP_Error|string $error
     */
    protected function getEntityMetaCRUDMutationException($error) : EntityMetaCRUDMutationException
    {
        $entityMetaCRUDMutationExceptionClass = $this->getEntityMetaCRUDMutationExceptionClass();
        if (\is_string($error)) {
            return new $entityMetaCRUDMutationExceptionClass($error);
        }
        /** @var WP_Error */
        $wpError = $error;
        return new $entityMetaCRUDMutationExceptionClass($wpError->get_error_message(), $wpError->get_error_code() ? $wpError->get_error_code() : null, $this->getWPErrorData($wpError));
    }
    /**
     * @phpstan-return class-string<EntityMetaCRUDMutationException>
     */
    protected abstract function getEntityMetaCRUDMutationExceptionClass() : string;
    /**
     * @param array<string,mixed[]|null> $entries
     * @throws EntityMetaCRUDMutationException If there was an error
     * @param string|int $entityID
     */
    public function setEntityMeta($entityID, array $entries) : void
    {
        foreach ($entries as $key => $values) {
            if ($values === null) {
                $this->executeDeleteEntityMeta($entityID, $key);
                continue;
            }
            $numberItems = \count($values);
            if ($numberItems === 0) {
                continue;
            }
            /**
             * If there are 2 or more items, then use `add` to add them.
             * If there is only 1 item, then use `update` to update it.
             */
            if ($numberItems === 1) {
                $value = $values[0];
                if ($value === null) {
                    $this->executeDeleteEntityMeta($entityID, $key);
                    continue;
                }
                $value = $this->maybeConvertStdClassToArray($value);
                $this->executeUpdateEntityMeta($entityID, $key, $value);
                continue;
            }
            // $numberItems > 1
            $this->executeDeleteEntityMeta($entityID, $key);
            foreach ($values as $value) {
                $value = $this->maybeConvertStdClassToArray($value);
                $this->executeAddEntityMeta($entityID, $key, $value, \false);
            }
        }
    }
    /**
     * @return int The term_id of the newly created term
     * @throws EntityMetaCRUDMutationException If there was an error
     * @param string|int $entityID
     * @param mixed $value
     */
    public function addEntityMeta($entityID, string $key, $value, bool $single = \false) : int
    {
        $value = $this->maybeConvertStdClassToArray($value);
        $result = $this->executeAddEntityMeta($entityID, $key, $value, $single);
        if ($result === \false) {
            throw $this->getEntityMetaCRUDMutationException($this->__('Error adding meta', 'meta-mutations'));
        }
        $this->handleMaybeError($result);
        /** @var int $result */
        return $result;
    }
    /**
     * Do not store stdClass objects in the database, convert them to arrays
     * @param mixed $value
     * @return mixed
     */
    protected function maybeConvertStdClassToArray($value)
    {
        if (!(\is_array($value) || $value instanceof stdClass)) {
            return $value;
        }
        return MethodHelpers::recursivelyConvertStdClassToAssociativeArray($value);
    }
    /**
     * @param string|int $entityID
     * @return int|false|\WP_Error
     * @param mixed $value
     */
    protected abstract function executeAddEntityMeta($entityID, string $key, $value, bool $single = \false);
    /**
     * @return string|int|bool the ID of the created meta entry if it didn't exist, or `true` if it did exist
     * @throws EntityMetaCRUDMutationException If there was an error (eg: entity does not exist)
     * @param string|int $entityID
     * @param mixed $value
     * @param mixed $prevValue
     */
    public function updateEntityMeta($entityID, string $key, $value, $prevValue = null)
    {
        $value = $this->maybeConvertStdClassToArray($value);
        $result = $this->executeUpdateEntityMeta($entityID, $key, $value, $prevValue ?? '');
        $this->handleMaybeError($result);
        if ($result === \false) {
            throw $this->getEntityMetaCRUDMutationException($this->__('Error updating meta', 'meta-mutations'));
        }
        /** @var int|bool $result */
        return $result;
    }
    /**
     * @param string|int $entityID
     * @return int|bool|\WP_Error
     * @param mixed $value
     * @param mixed $prevValue
     */
    protected abstract function executeUpdateEntityMeta($entityID, string $key, $value, $prevValue = null);
    /**
     * @throws EntityMetaCRUDMutationException If there was an error (eg: entity does not exist)
     * @param string|int $entityID
     * @param mixed $value
     */
    public function deleteEntityMeta($entityID, string $key, $value = null) : void
    {
        $result = $this->executeDeleteEntityMeta($entityID, $key, $value);
        $this->handleMaybeError($result);
        if ($result === \false) {
            throw $this->getEntityMetaCRUDMutationException($this->__('Error deleting meta', 'meta-mutations'));
        }
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected abstract function executeDeleteEntityMeta($entityID, string $key, $value = null) : bool;
}
