<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\MutationResolvers;

use PoPCMSSchema\MetaMutations\MutationResolvers\MutateEntityMetaMutationResolverTrait;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
use PoPCMSSchema\UserMeta\TypeAPIs\UserMetaTypeAPIInterface;
/** @internal */
trait MutateUserMetaMutationResolverTrait
{
    use MutateEntityMetaMutationResolverTrait;
    protected abstract function getUserMetaTypeAPI() : UserMetaTypeAPIInterface;
    protected function getMetaTypeAPI() : MetaTypeAPIInterface
    {
        return $this->getUserMetaTypeAPI();
    }
    /**
     * @param string|int $entityID
     */
    protected function doesMetaEntryExist($entityID, string $key) : bool
    {
        return $this->getUserMetaTypeAPI()->getUserMeta($entityID, $key, \true) !== null;
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function doesMetaEntryWithValueExist($entityID, string $key, $value) : bool
    {
        return \in_array($value, $this->getUserMetaTypeAPI()->getUserMeta($entityID, $key, \false));
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function doesMetaEntryHaveValue($entityID, string $key, $value) : bool
    {
        $existingValue = $this->getUserMetaTypeAPI()->getUserMeta($entityID, $key, \false);
        return $existingValue === [$value];
    }
}
