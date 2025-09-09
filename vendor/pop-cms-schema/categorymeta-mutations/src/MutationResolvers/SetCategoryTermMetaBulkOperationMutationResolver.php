<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class SetCategoryTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\SetCategoryTermMetaMutationResolver $setCategoryTermMetaMutationResolver = null;
    protected final function getSetCategoryTermMetaMutationResolver() : \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\SetCategoryTermMetaMutationResolver
    {
        if ($this->setCategoryTermMetaMutationResolver === null) {
            /** @var SetCategoryTermMetaMutationResolver */
            $setCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\SetCategoryTermMetaMutationResolver::class);
            $this->setCategoryTermMetaMutationResolver = $setCategoryTermMetaMutationResolver;
        }
        return $this->setCategoryTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetCategoryTermMetaMutationResolver();
    }
}
