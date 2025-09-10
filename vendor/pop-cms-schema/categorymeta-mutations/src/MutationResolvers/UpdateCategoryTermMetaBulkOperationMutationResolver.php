<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateCategoryTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\UpdateCategoryTermMetaMutationResolver $updateCategoryTermMetaMutationResolver = null;
    protected final function getUpdateCategoryTermMetaMutationResolver() : \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\UpdateCategoryTermMetaMutationResolver
    {
        if ($this->updateCategoryTermMetaMutationResolver === null) {
            /** @var UpdateCategoryTermMetaMutationResolver */
            $updateCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\UpdateCategoryTermMetaMutationResolver::class);
            $this->updateCategoryTermMetaMutationResolver = $updateCategoryTermMetaMutationResolver;
        }
        return $this->updateCategoryTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateCategoryTermMetaMutationResolver();
    }
}
