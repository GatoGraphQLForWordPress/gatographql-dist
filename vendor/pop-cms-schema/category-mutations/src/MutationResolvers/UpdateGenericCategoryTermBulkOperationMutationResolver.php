<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateGenericCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver|null
     */
    private $updateGenericCategoryTermMutationResolver;
    public final function setUpdateGenericCategoryTermMutationResolver(\PoPCMSSchema\CategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver $updateGenericCategoryTermMutationResolver) : void
    {
        $this->updateGenericCategoryTermMutationResolver = $updateGenericCategoryTermMutationResolver;
    }
    protected final function getUpdateGenericCategoryTermMutationResolver() : \PoPCMSSchema\CategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver
    {
        if ($this->updateGenericCategoryTermMutationResolver === null) {
            /** @var UpdateGenericCategoryTermMutationResolver */
            $updateGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver::class);
            $this->updateGenericCategoryTermMutationResolver = $updateGenericCategoryTermMutationResolver;
        }
        return $this->updateGenericCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateGenericCategoryTermMutationResolver();
    }
}
