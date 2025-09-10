<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreatePageBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PageMutations\MutationResolvers\CreatePageMutationResolver $createPageMutationResolver = null;
    protected final function getCreatePageMutationResolver() : \PoPCMSSchema\PageMutations\MutationResolvers\CreatePageMutationResolver
    {
        if ($this->createPageMutationResolver === null) {
            /** @var CreatePageMutationResolver */
            $createPageMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PageMutations\MutationResolvers\CreatePageMutationResolver::class);
            $this->createPageMutationResolver = $createPageMutationResolver;
        }
        return $this->createPageMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreatePageMutationResolver();
    }
}
