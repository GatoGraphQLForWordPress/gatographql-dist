<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class SetCommentMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaMutationResolver $setCommentMetaMutationResolver = null;
    protected final function getSetCommentMetaMutationResolver() : \PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaMutationResolver
    {
        if ($this->setCommentMetaMutationResolver === null) {
            /** @var SetCommentMetaMutationResolver */
            $setCommentMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMetaMutations\MutationResolvers\SetCommentMetaMutationResolver::class);
            $this->setCommentMetaMutationResolver = $setCommentMetaMutationResolver;
        }
        return $this->setCommentMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetCommentMetaMutationResolver();
    }
}
