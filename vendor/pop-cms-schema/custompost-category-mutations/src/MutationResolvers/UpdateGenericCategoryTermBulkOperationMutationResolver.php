<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateGenericCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\UpdateGenericCategoryTermMutationResolver $updateGenericCategoryTermMutationResolver = null;
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
