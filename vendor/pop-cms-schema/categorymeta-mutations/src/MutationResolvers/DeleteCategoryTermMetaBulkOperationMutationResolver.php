<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteCategoryTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\DeleteCategoryTermMetaMutationResolver $deleteCategoryTermMetaMutationResolver = null;
    protected final function getDeleteCategoryTermMetaMutationResolver() : \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\DeleteCategoryTermMetaMutationResolver
    {
        if ($this->deleteCategoryTermMetaMutationResolver === null) {
            /** @var DeleteCategoryTermMetaMutationResolver */
            $deleteCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\DeleteCategoryTermMetaMutationResolver::class);
            $this->deleteCategoryTermMetaMutationResolver = $deleteCategoryTermMetaMutationResolver;
        }
        return $this->deleteCategoryTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteCategoryTermMetaMutationResolver();
    }
}
