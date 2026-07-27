<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteCommentBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableDeleteCommentMutationResolver $payloadableDeleteCommentMutationResolver = null;
    protected final function getPayloadableDeleteCommentMutationResolver() : \PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableDeleteCommentMutationResolver
    {
        if ($this->payloadableDeleteCommentMutationResolver === null) {
            /** @var PayloadableDeleteCommentMutationResolver */
            $payloadableDeleteCommentMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableDeleteCommentMutationResolver::class);
            $this->payloadableDeleteCommentMutationResolver = $payloadableDeleteCommentMutationResolver;
        }
        return $this->payloadableDeleteCommentMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteCommentMutationResolver();
    }
}
