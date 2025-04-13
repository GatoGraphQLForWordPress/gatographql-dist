<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class SetTagTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolver|null
     */
    private $setTagTermMetaMutationResolver;
    protected final function getSetTagTermMetaMutationResolver() : \PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolver
    {
        if ($this->setTagTermMetaMutationResolver === null) {
            /** @var SetTagTermMetaMutationResolver */
            $setTagTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMetaMutations\MutationResolvers\SetTagTermMetaMutationResolver::class);
            $this->setTagTermMetaMutationResolver = $setTagTermMetaMutationResolver;
        }
        return $this->setTagTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetTagTermMetaMutationResolver();
    }
}
