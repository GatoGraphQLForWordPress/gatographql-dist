<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteGenericCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver|null
     */
    private $deleteGenericCategoryTermMutationResolver;
    public final function setDeleteGenericCategoryTermMutationResolver(\PoPCMSSchema\CategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver $deleteGenericCategoryTermMutationResolver) : void
    {
        $this->deleteGenericCategoryTermMutationResolver = $deleteGenericCategoryTermMutationResolver;
    }
    protected final function getDeleteGenericCategoryTermMutationResolver() : \PoPCMSSchema\CategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver
    {
        if ($this->deleteGenericCategoryTermMutationResolver === null) {
            /** @var DeleteGenericCategoryTermMutationResolver */
            $deleteGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver::class);
            $this->deleteGenericCategoryTermMutationResolver = $deleteGenericCategoryTermMutationResolver;
        }
        return $this->deleteGenericCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteGenericCategoryTermMutationResolver();
    }
}
