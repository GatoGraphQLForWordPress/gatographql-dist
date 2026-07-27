<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateCommentBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableUpdateCommentMutationResolver $payloadableUpdateCommentMutationResolver = null;
    protected final function getPayloadableUpdateCommentMutationResolver() : \PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableUpdateCommentMutationResolver
    {
        if ($this->payloadableUpdateCommentMutationResolver === null) {
            /** @var PayloadableUpdateCommentMutationResolver */
            $payloadableUpdateCommentMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableUpdateCommentMutationResolver::class);
            $this->payloadableUpdateCommentMutationResolver = $payloadableUpdateCommentMutationResolver;
        }
        return $this->payloadableUpdateCommentMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateCommentMutationResolver();
    }
}
