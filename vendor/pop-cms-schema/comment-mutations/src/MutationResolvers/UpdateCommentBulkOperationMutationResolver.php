<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateCommentBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMutations\MutationResolvers\UpdateCommentMutationResolver $updateCommentMutationResolver = null;
    protected final function getUpdateCommentMutationResolver() : \PoPCMSSchema\CommentMutations\MutationResolvers\UpdateCommentMutationResolver
    {
        if ($this->updateCommentMutationResolver === null) {
            /** @var UpdateCommentMutationResolver */
            $updateCommentMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMutations\MutationResolvers\UpdateCommentMutationResolver::class);
            $this->updateCommentMutationResolver = $updateCommentMutationResolver;
        }
        return $this->updateCommentMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateCommentMutationResolver();
    }
}
