<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateCommentMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableUpdateCommentMetaMutationResolver|null
     */
    private $payloadableUpdateCommentMetaMutationResolver;
    protected final function getPayloadableUpdateCommentMetaMutationResolver() : \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableUpdateCommentMetaMutationResolver
    {
        if ($this->payloadableUpdateCommentMetaMutationResolver === null) {
            /** @var PayloadableUpdateCommentMetaMutationResolver */
            $payloadableUpdateCommentMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableUpdateCommentMetaMutationResolver::class);
            $this->payloadableUpdateCommentMetaMutationResolver = $payloadableUpdateCommentMetaMutationResolver;
        }
        return $this->payloadableUpdateCommentMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateCommentMetaMutationResolver();
    }
}
