<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class AddCategoryTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolver $addCategoryTermMetaMutationResolver = null;
    protected final function getAddCategoryTermMetaMutationResolver() : \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolver
    {
        if ($this->addCategoryTermMetaMutationResolver === null) {
            /** @var AddCategoryTermMetaMutationResolver */
            $addCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\AddCategoryTermMetaMutationResolver::class);
            $this->addCategoryTermMetaMutationResolver = $addCategoryTermMetaMutationResolver;
        }
        return $this->addCategoryTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getAddCategoryTermMetaMutationResolver();
    }
}
