<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMetaMutations\Hooks;

use PoPCMSSchema\MetaMutations\Hooks\AbstractMetaMutationResolverHookSet;
use PoPCMSSchema\MetaMutations\TypeAPIs\EntityMetaTypeMutationAPIInterface;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
use PoPCMSSchema\TaxonomyMetaMutations\MutationResolvers\MutateTaxonomyTermMetaMutationResolverTrait;
use PoPCMSSchema\TaxonomyMetaMutations\TypeAPIs\TaxonomyMetaTypeMutationAPIInterface;
use PoPCMSSchema\TaxonomyMeta\TypeAPIs\TaxonomyMetaTypeAPIInterface;
/** @internal */
abstract class AbstractTaxonomyMetaMutationResolverHookSet extends AbstractMetaMutationResolverHookSet
{
    use MutateTaxonomyTermMetaMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\TaxonomyMetaMutations\TypeAPIs\TaxonomyMetaTypeMutationAPIInterface|null
     */
    private $taxonomyMetaTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\TaxonomyMeta\TypeAPIs\TaxonomyMetaTypeAPIInterface|null
     */
    private $taxonomyMetaTypeAPI;
    protected final function getTaxonomyMetaTypeMutationAPI() : TaxonomyMetaTypeMutationAPIInterface
    {
        if ($this->taxonomyMetaTypeMutationAPI === null) {
            /** @var TaxonomyMetaTypeMutationAPIInterface */
            $taxonomyMetaTypeMutationAPI = $this->instanceManager->getInstance(TaxonomyMetaTypeMutationAPIInterface::class);
            $this->taxonomyMetaTypeMutationAPI = $taxonomyMetaTypeMutationAPI;
        }
        return $this->taxonomyMetaTypeMutationAPI;
    }
    protected final function getTaxonomyMetaTypeAPI() : TaxonomyMetaTypeAPIInterface
    {
        if ($this->taxonomyMetaTypeAPI === null) {
            /** @var TaxonomyMetaTypeAPIInterface */
            $taxonomyMetaTypeAPI = $this->instanceManager->getInstance(TaxonomyMetaTypeAPIInterface::class);
            $this->taxonomyMetaTypeAPI = $taxonomyMetaTypeAPI;
        }
        return $this->taxonomyMetaTypeAPI;
    }
    protected function getEntityMetaTypeMutationAPI() : EntityMetaTypeMutationAPIInterface
    {
        return $this->getTaxonomyMetaTypeMutationAPI();
    }
    protected function getMetaTypeAPI() : MetaTypeAPIInterface
    {
        return $this->getTaxonomyMetaTypeAPI();
    }
}
