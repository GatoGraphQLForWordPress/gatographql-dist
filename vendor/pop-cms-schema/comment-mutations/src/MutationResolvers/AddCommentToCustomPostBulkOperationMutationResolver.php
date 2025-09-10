<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class AddCommentToCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMutations\MutationResolvers\AddCommentToCustomPostMutationResolver $addCommentToCustomPostMutationResolver = null;
    protected final function getAddCommentToCustomPostMutationResolver() : \PoPCMSSchema\CommentMutations\MutationResolvers\AddCommentToCustomPostMutationResolver
    {
        if ($this->addCommentToCustomPostMutationResolver === null) {
            /** @var AddCommentToCustomPostMutationResolver */
            $addCommentToCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMutations\MutationResolvers\AddCommentToCustomPostMutationResolver::class);
            $this->addCommentToCustomPostMutationResolver = $addCommentToCustomPostMutationResolver;
        }
        return $this->addCommentToCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getAddCommentToCustomPostMutationResolver();
    }
}
