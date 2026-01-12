<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreateMenuBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MenuMutations\MutationResolvers\CreateMenuMutationResolver $createMenuMutationResolver = null;
    protected final function getCreateMenuMutationResolver() : \PoPCMSSchema\MenuMutations\MutationResolvers\CreateMenuMutationResolver
    {
        if ($this->createMenuMutationResolver === null) {
            /** @var CreateMenuMutationResolver */
            $createMenuMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MenuMutations\MutationResolvers\CreateMenuMutationResolver::class);
            $this->createMenuMutationResolver = $createMenuMutationResolver;
        }
        return $this->createMenuMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreateMenuMutationResolver();
    }
}
