<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMetaMutations\MutationResolvers;

use PoPCMSSchema\MetaMutations\MutationResolvers\MutateEntityMetaMutationResolverTrait;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
use PoPCMSSchema\TaxonomyMeta\TypeAPIs\TaxonomyMetaTypeAPIInterface;
/** @internal */
trait MutateTaxonomyTermMetaMutationResolverTrait
{
    use MutateEntityMetaMutationResolverTrait;
    protected abstract function getTaxonomyMetaTypeAPI() : TaxonomyMetaTypeAPIInterface;
    protected function getMetaTypeAPI() : MetaTypeAPIInterface
    {
        return $this->getTaxonomyMetaTypeAPI();
    }
    /**
     * @param string|int $entityID
     */
    protected function doesMetaEntryExist($entityID, string $key) : bool
    {
        return $this->getTaxonomyMetaTypeAPI()->getTaxonomyTermMeta($entityID, $key, \true) !== null;
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function doesMetaEntryWithValueExist($entityID, string $key, $value) : bool
    {
        return \in_array($value, $this->getTaxonomyMetaTypeAPI()->getTaxonomyTermMeta($entityID, $key, \false));
    }
    /**
     * @param string|int $entityID
     * @param mixed $value
     */
    protected function doesMetaEntryHaveValue($entityID, string $key, $value) : bool
    {
        $existingValue = $this->getTaxonomyMetaTypeAPI()->getTaxonomyTermMeta($entityID, $key, \false);
        return $existingValue === [$value];
    }
}
