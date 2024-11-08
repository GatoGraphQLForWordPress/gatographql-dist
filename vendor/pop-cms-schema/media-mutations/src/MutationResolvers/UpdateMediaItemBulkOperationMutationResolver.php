<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateMediaItemBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\UpdateMediaItemMutationResolver|null
     */
    private $updateMediaItemMutationResolver;
    protected final function getUpdateMediaItemMutationResolver() : \PoPCMSSchema\MediaMutations\MutationResolvers\UpdateMediaItemMutationResolver
    {
        if ($this->updateMediaItemMutationResolver === null) {
            /** @var UpdateMediaItemMutationResolver */
            $updateMediaItemMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\MutationResolvers\UpdateMediaItemMutationResolver::class);
            $this->updateMediaItemMutationResolver = $updateMediaItemMutationResolver;
        }
        return $this->updateMediaItemMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateMediaItemMutationResolver();
    }
}
