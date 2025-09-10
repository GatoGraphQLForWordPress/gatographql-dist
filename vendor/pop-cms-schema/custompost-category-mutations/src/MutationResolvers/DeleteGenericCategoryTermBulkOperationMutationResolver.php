<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteGenericCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver $deleteGenericCategoryTermMutationResolver = null;
    protected final function getDeleteGenericCategoryTermMutationResolver() : \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver
    {
        if ($this->deleteGenericCategoryTermMutationResolver === null) {
            /** @var DeleteGenericCategoryTermMutationResolver */
            $deleteGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\DeleteGenericCategoryTermMutationResolver::class);
            $this->deleteGenericCategoryTermMutationResolver = $deleteGenericCategoryTermMutationResolver;
        }
        return $this->deleteGenericCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteGenericCategoryTermMutationResolver();
    }
}
