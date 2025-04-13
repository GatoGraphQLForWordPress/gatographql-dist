<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class AddCommentMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\AddCommentMetaMutationResolver|null
     */
    private $addCommentMetaMutationResolver;
    protected final function getAddCommentMetaMutationResolver() : \PoPCMSSchema\CommentMetaMutations\MutationResolvers\AddCommentMetaMutationResolver
    {
        if ($this->addCommentMetaMutationResolver === null) {
            /** @var AddCommentMetaMutationResolver */
            $addCommentMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMetaMutations\MutationResolvers\AddCommentMetaMutationResolver::class);
            $this->addCommentMetaMutationResolver = $addCommentMetaMutationResolver;
        }
        return $this->addCommentMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getAddCommentMetaMutationResolver();
    }
}
