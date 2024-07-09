<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreatePageBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\CreatePageMutationResolver|null
     */
    private $createPageMutationResolver;
    public final function setCreatePageMutationResolver(\PoPCMSSchema\PageMutations\MutationResolvers\CreatePageMutationResolver $createPageMutationResolver) : void
    {
        $this->createPageMutationResolver = $createPageMutationResolver;
    }
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
