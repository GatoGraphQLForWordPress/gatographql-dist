<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateGenericCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver|null
     */
    private $updateGenericCategoryTermMutationResolver;
    public final function setUpdateGenericCategoryTermMutationResolver(\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver $updateGenericCategoryTermMutationResolver) : void
    {
        $this->updateGenericCategoryTermMutationResolver = $updateGenericCategoryTermMutationResolver;
    }
    protected final function getUpdateGenericCategoryTermMutationResolver() : \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver
    {
        if ($this->updateGenericCategoryTermMutationResolver === null) {
            /** @var UpdateGenericCategoryTermMutationResolver */
            $updateGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver::class);
            $this->updateGenericCategoryTermMutationResolver = $updateGenericCategoryTermMutationResolver;
        }
        return $this->updateGenericCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateGenericCategoryTermMutationResolver();
    }
}
