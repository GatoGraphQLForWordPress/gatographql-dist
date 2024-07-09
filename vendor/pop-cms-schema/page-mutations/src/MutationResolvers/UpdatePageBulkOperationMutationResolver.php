<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdatePageBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\UpdatePageMutationResolver|null
     */
    private $updatePageMutationResolver;
    public final function setUpdatePageMutationResolver(\PoPCMSSchema\PageMutations\MutationResolvers\UpdatePageMutationResolver $updatePageMutationResolver) : void
    {
        $this->updatePageMutationResolver = $updatePageMutationResolver;
    }
    protected final function getUpdatePageMutationResolver() : \PoPCMSSchema\PageMutations\MutationResolvers\UpdatePageMutationResolver
    {
        if ($this->updatePageMutationResolver === null) {
            /** @var UpdatePageMutationResolver */
            $updatePageMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PageMutations\MutationResolvers\UpdatePageMutationResolver::class);
            $this->updatePageMutationResolver = $updatePageMutationResolver;
        }
        return $this->updatePageMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdatePageMutationResolver();
    }
}
