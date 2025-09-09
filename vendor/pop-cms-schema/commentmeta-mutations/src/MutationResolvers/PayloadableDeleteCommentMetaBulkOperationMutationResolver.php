<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteCommentMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableDeleteCommentMetaMutationResolver $payloadableDeleteCommentMetaMutationResolver = null;
    protected final function getPayloadableDeleteCommentMetaMutationResolver() : \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableDeleteCommentMetaMutationResolver
    {
        if ($this->payloadableDeleteCommentMetaMutationResolver === null) {
            /** @var PayloadableDeleteCommentMetaMutationResolver */
            $payloadableDeleteCommentMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableDeleteCommentMetaMutationResolver::class);
            $this->payloadableDeleteCommentMetaMutationResolver = $payloadableDeleteCommentMetaMutationResolver;
        }
        return $this->payloadableDeleteCommentMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteCommentMetaMutationResolver();
    }
}
