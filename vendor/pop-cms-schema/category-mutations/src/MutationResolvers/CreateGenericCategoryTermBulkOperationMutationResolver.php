<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreateGenericCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\MutationResolvers\CreateGenericCategoryTermMutationResolver|null
     */
    private $createGenericCategoryTermMutationResolver;
    public final function setCreateGenericCategoryTermMutationResolver(\PoPCMSSchema\CategoryMutations\MutationResolvers\CreateGenericCategoryTermMutationResolver $createGenericCategoryTermMutationResolver) : void
    {
        $this->createGenericCategoryTermMutationResolver = $createGenericCategoryTermMutationResolver;
    }
    protected final function getCreateGenericCategoryTermMutationResolver() : \PoPCMSSchema\CategoryMutations\MutationResolvers\CreateGenericCategoryTermMutationResolver
    {
        if ($this->createGenericCategoryTermMutationResolver === null) {
            /** @var CreateGenericCategoryTermMutationResolver */
            $createGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMutations\MutationResolvers\CreateGenericCategoryTermMutationResolver::class);
            $this->createGenericCategoryTermMutationResolver = $createGenericCategoryTermMutationResolver;
        }
        return $this->createGenericCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreateGenericCategoryTermMutationResolver();
    }
}
