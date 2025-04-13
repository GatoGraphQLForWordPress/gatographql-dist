<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateTagTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\UpdateTagTermMetaMutationResolver|null
     */
    private $updateTagTermMetaMutationResolver;
    protected final function getUpdateTagTermMetaMutationResolver() : \PoPCMSSchema\TagMetaMutations\MutationResolvers\UpdateTagTermMetaMutationResolver
    {
        if ($this->updateTagTermMetaMutationResolver === null) {
            /** @var UpdateTagTermMetaMutationResolver */
            $updateTagTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMetaMutations\MutationResolvers\UpdateTagTermMetaMutationResolver::class);
            $this->updateTagTermMetaMutationResolver = $updateTagTermMetaMutationResolver;
        }
        return $this->updateTagTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateTagTermMetaMutationResolver();
    }
}
