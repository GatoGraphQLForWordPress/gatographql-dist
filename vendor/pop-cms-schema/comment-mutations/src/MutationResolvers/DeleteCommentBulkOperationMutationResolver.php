<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteCommentBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMutations\MutationResolvers\DeleteCommentMutationResolver $deleteCommentMutationResolver = null;
    protected final function getDeleteCommentMutationResolver() : \PoPCMSSchema\CommentMutations\MutationResolvers\DeleteCommentMutationResolver
    {
        if ($this->deleteCommentMutationResolver === null) {
            /** @var DeleteCommentMutationResolver */
            $deleteCommentMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMutations\MutationResolvers\DeleteCommentMutationResolver::class);
            $this->deleteCommentMutationResolver = $deleteCommentMutationResolver;
        }
        return $this->deleteCommentMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteCommentMutationResolver();
    }
}
