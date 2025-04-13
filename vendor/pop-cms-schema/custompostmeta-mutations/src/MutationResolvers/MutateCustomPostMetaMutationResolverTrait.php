<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\MetaMutations\MutationResolvers\MutateEntityMetaMutationResolverTrait;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
use PoPCMSSchema\CustomPostMeta\TypeAPIs\CustomPostMetaTypeAPIInterface;
/** @internal */
trait MutateCustomPostMetaMutationResolverTrait
{
    use MutateEntityMetaMutationResolverTrait;
    protected abstract function getCustomPostMetaTypeAPI() : CustomPostMetaTypeAPIInterface;
    protected function getMetaTypeAPI() : MetaTypeAPIInterface
    {
        return $this->getCustomPostMetaTypeAPI();
    }
    /**
     * @param string|int $entityID
     */
    protected function doesMetaEntryExist($entityID, string $key) : bool
    {
        return $this->getCustomPostMetaTypeAPI()->getCustomPostMeta($entityID, $key, \true) !== null;
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function doesMetaEntryWithValueExist($entityID, string $key, $value) : bool
    {
        return \in_array($value, $this->getCustomPostMetaTypeAPI()->getCustomPostMeta($entityID, $key, \false));
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function doesMetaEntryHaveValue($entityID, string $key, $value) : bool
    {
        $existingValue = $this->getCustomPostMetaTypeAPI()->getCustomPostMeta($entityID, $key, \false);
        return $existingValue === [$value];
    }
}
