<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteMenuBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MenuMutations\MutationResolvers\DeleteMenuMutationResolver $deleteMenuMutationResolver = null;
    protected final function getDeleteMenuMutationResolver() : \PoPCMSSchema\MenuMutations\MutationResolvers\DeleteMenuMutationResolver
    {
        if ($this->deleteMenuMutationResolver === null) {
            /** @var DeleteMenuMutationResolver */
            $deleteMenuMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MenuMutations\MutationResolvers\DeleteMenuMutationResolver::class);
            $this->deleteMenuMutationResolver = $deleteMenuMutationResolver;
        }
        return $this->deleteMenuMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteMenuMutationResolver();
    }
}
