<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateCommentMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMetaMutations\MutationResolvers\UpdateCommentMetaMutationResolver $updateCommentMetaMutationResolver = null;
    protected final function getUpdateCommentMetaMutationResolver() : \PoPCMSSchema\CommentMetaMutations\MutationResolvers\UpdateCommentMetaMutationResolver
    {
        if ($this->updateCommentMetaMutationResolver === null) {
            /** @var UpdateCommentMetaMutationResolver */
            $updateCommentMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMetaMutations\MutationResolvers\UpdateCommentMetaMutationResolver::class);
            $this->updateCommentMetaMutationResolver = $updateCommentMetaMutationResolver;
        }
        return $this->updateCommentMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateCommentMetaMutationResolver();
    }
}
