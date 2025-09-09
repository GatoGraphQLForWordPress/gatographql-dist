<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreatePostTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostTagMutations\MutationResolvers\CreatePostTagTermMutationResolver $createPostTagTermMutationResolver = null;
    protected final function getCreatePostTagTermMutationResolver() : \PoPCMSSchema\PostTagMutations\MutationResolvers\CreatePostTagTermMutationResolver
    {
        if ($this->createPostTagTermMutationResolver === null) {
            /** @var CreatePostTagTermMutationResolver */
            $createPostTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostTagMutations\MutationResolvers\CreatePostTagTermMutationResolver::class);
            $this->createPostTagTermMutationResolver = $createPostTagTermMutationResolver;
        }
        return $this->createPostTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreatePostTagTermMutationResolver();
    }
}
