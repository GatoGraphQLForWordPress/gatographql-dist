<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class SetCategoriesOnCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolver $setCategoriesOnCustomPostMutationResolver = null;
    protected final function getSetCategoriesOnCustomPostMutationResolver() : \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolver
    {
        if ($this->setCategoriesOnCustomPostMutationResolver === null) {
            /** @var SetCategoriesOnCustomPostMutationResolver */
            $setCategoriesOnCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\SetCategoriesOnCustomPostMutationResolver::class);
            $this->setCategoriesOnCustomPostMutationResolver = $setCategoriesOnCustomPostMutationResolver;
        }
        return $this->setCategoriesOnCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetCategoriesOnCustomPostMutationResolver();
    }
}
