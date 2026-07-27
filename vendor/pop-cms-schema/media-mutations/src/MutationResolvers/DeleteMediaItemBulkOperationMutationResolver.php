<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteMediaItemBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MediaMutations\MutationResolvers\DeleteMediaItemMutationResolver $deleteMediaItemMutationResolver = null;
    protected final function getDeleteMediaItemMutationResolver() : \PoPCMSSchema\MediaMutations\MutationResolvers\DeleteMediaItemMutationResolver
    {
        if ($this->deleteMediaItemMutationResolver === null) {
            /** @var DeleteMediaItemMutationResolver */
            $deleteMediaItemMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\MutationResolvers\DeleteMediaItemMutationResolver::class);
            $this->deleteMediaItemMutationResolver = $deleteMediaItemMutationResolver;
        }
        return $this->deleteMediaItemMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteMediaItemMutationResolver();
    }
}
