<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeletePostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostMutations\MutationResolvers\DeletePostMutationResolver $deletePostMutationResolver = null;
    protected final function getDeletePostMutationResolver() : \PoPCMSSchema\PostMutations\MutationResolvers\DeletePostMutationResolver
    {
        if ($this->deletePostMutationResolver === null) {
            /** @var DeletePostMutationResolver */
            $deletePostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostMutations\MutationResolvers\DeletePostMutationResolver::class);
            $this->deletePostMutationResolver = $deletePostMutationResolver;
        }
        return $this->deletePostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeletePostMutationResolver();
    }
}
