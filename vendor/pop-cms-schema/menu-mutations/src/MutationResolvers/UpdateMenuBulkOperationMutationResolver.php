<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateMenuBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MenuMutations\MutationResolvers\UpdateMenuMutationResolver $updateMenuMutationResolver = null;
    protected final function getUpdateMenuMutationResolver() : \PoPCMSSchema\MenuMutations\MutationResolvers\UpdateMenuMutationResolver
    {
        if ($this->updateMenuMutationResolver === null) {
            /** @var UpdateMenuMutationResolver */
            $updateMenuMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MenuMutations\MutationResolvers\UpdateMenuMutationResolver::class);
            $this->updateMenuMutationResolver = $updateMenuMutationResolver;
        }
        return $this->updateMenuMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateMenuMutationResolver();
    }
}
