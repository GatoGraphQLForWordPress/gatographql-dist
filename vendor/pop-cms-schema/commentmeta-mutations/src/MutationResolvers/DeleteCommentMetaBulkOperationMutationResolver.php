<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteCommentMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\DeleteCommentMetaMutationResolver|null
     */
    private $deleteCommentMetaMutationResolver;
    protected final function getDeleteCommentMetaMutationResolver() : \PoPCMSSchema\CommentMetaMutations\MutationResolvers\DeleteCommentMetaMutationResolver
    {
        if ($this->deleteCommentMetaMutationResolver === null) {
            /** @var DeleteCommentMetaMutationResolver */
            $deleteCommentMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMetaMutations\MutationResolvers\DeleteCommentMetaMutationResolver::class);
            $this->deleteCommentMetaMutationResolver = $deleteCommentMetaMutationResolver;
        }
        return $this->deleteCommentMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteCommentMetaMutationResolver();
    }
}
