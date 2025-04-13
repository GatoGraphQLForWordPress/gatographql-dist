<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableAddCommentMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableAddCommentMetaMutationResolver|null
     */
    private $payloadableAddCommentMetaMutationResolver;
    protected final function getPayloadableAddCommentMetaMutationResolver() : \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableAddCommentMetaMutationResolver
    {
        if ($this->payloadableAddCommentMetaMutationResolver === null) {
            /** @var PayloadableAddCommentMetaMutationResolver */
            $payloadableAddCommentMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableAddCommentMetaMutationResolver::class);
            $this->payloadableAddCommentMetaMutationResolver = $payloadableAddCommentMetaMutationResolver;
        }
        return $this->payloadableAddCommentMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableAddCommentMetaMutationResolver();
    }
}
