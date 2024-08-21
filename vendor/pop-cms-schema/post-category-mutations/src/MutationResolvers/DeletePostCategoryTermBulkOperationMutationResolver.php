<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeletePostCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermMutationResolver|null
     */
    private $deletePostCategoryTermMutationResolver;
    public final function setDeletePostCategoryTermMutationResolver(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermMutationResolver $deletePostCategoryTermMutationResolver) : void
    {
        $this->deletePostCategoryTermMutationResolver = $deletePostCategoryTermMutationResolver;
    }
    protected final function getDeletePostCategoryTermMutationResolver() : \PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermMutationResolver
    {
        if ($this->deletePostCategoryTermMutationResolver === null) {
            /** @var DeletePostCategoryTermMutationResolver */
            $deletePostCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\DeletePostCategoryTermMutationResolver::class);
            $this->deletePostCategoryTermMutationResolver = $deletePostCategoryTermMutationResolver;
        }
        return $this->deletePostCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeletePostCategoryTermMutationResolver();
    }
}
