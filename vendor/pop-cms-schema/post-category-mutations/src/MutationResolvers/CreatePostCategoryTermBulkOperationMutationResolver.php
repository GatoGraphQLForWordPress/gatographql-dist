<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreatePostCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\CreatePostCategoryTermMutationResolver|null
     */
    private $createPostCategoryTermMutationResolver;
    public final function setCreatePostCategoryTermMutationResolver(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\CreatePostCategoryTermMutationResolver $createPostCategoryTermMutationResolver) : void
    {
        $this->createPostCategoryTermMutationResolver = $createPostCategoryTermMutationResolver;
    }
    protected final function getCreatePostCategoryTermMutationResolver() : \PoPCMSSchema\PostCategoryMutations\MutationResolvers\CreatePostCategoryTermMutationResolver
    {
        if ($this->createPostCategoryTermMutationResolver === null) {
            /** @var CreatePostCategoryTermMutationResolver */
            $createPostCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\CreatePostCategoryTermMutationResolver::class);
            $this->createPostCategoryTermMutationResolver = $createPostCategoryTermMutationResolver;
        }
        return $this->createPostCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreatePostCategoryTermMutationResolver();
    }
}
