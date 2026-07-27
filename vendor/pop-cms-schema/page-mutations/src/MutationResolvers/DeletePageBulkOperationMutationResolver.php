<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeletePageBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PageMutations\MutationResolvers\DeletePageMutationResolver $deletePageMutationResolver = null;
    protected final function getDeletePageMutationResolver() : \PoPCMSSchema\PageMutations\MutationResolvers\DeletePageMutationResolver
    {
        if ($this->deletePageMutationResolver === null) {
            /** @var DeletePageMutationResolver */
            $deletePageMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PageMutations\MutationResolvers\DeletePageMutationResolver::class);
            $this->deletePageMutationResolver = $deletePageMutationResolver;
        }
        return $this->deletePageMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeletePageMutationResolver();
    }
}
