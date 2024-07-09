<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreateMediaItemBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemMutationResolver|null
     */
    private $createMediaItemMutationResolver;
    public final function setCreateMediaItemMutationResolver(\PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemMutationResolver $createMediaItemMutationResolver) : void
    {
        $this->createMediaItemMutationResolver = $createMediaItemMutationResolver;
    }
    protected final function getCreateMediaItemMutationResolver() : \PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemMutationResolver
    {
        if ($this->createMediaItemMutationResolver === null) {
            /** @var CreateMediaItemMutationResolver */
            $createMediaItemMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\MutationResolvers\CreateMediaItemMutationResolver::class);
            $this->createMediaItemMutationResolver = $createMediaItemMutationResolver;
        }
        return $this->createMediaItemMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreateMediaItemMutationResolver();
    }
}
