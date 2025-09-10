<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetCommentMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableSetCommentMetaMutationResolver $payloadableSetCommentMetaMutationResolver = null;
    protected final function getPayloadableSetCommentMetaMutationResolver() : \PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableSetCommentMetaMutationResolver
    {
        if ($this->payloadableSetCommentMetaMutationResolver === null) {
            /** @var PayloadableSetCommentMetaMutationResolver */
            $payloadableSetCommentMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CommentMetaMutations\MutationResolvers\PayloadableSetCommentMetaMutationResolver::class);
            $this->payloadableSetCommentMetaMutationResolver = $payloadableSetCommentMetaMutationResolver;
        }
        return $this->payloadableSetCommentMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetCommentMetaMutationResolver();
    }
}
