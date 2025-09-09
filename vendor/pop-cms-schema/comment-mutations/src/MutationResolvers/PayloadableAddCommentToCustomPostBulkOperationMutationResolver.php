<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableAddCommentToCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostMutationResolver $payloadableAddCommentToCustomPostMutationResolver = null;
    protected final function getPayloadableAddCommentToCustomPostMutationResolver() : \PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostMutationResolver
    {
        if ($this->payloadableAddCommentToCustomPostMutationResolver === null) {
            /** @var PayloadableAddCommentToCustomPostMutationResolver */
            $payloadableAddCommentToCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMutations\MutationResolvers\PayloadableAddCommentToCustomPostMutationResolver::class);
            $this->payloadableAddCommentToCustomPostMutationResolver = $payloadableAddCommentToCustomPostMutationResolver;
        }
        return $this->payloadableAddCommentToCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableAddCommentToCustomPostMutationResolver();
    }
}
