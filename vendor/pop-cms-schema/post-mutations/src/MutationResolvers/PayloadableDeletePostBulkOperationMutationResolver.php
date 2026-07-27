<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeletePostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostMutations\MutationResolvers\PayloadableDeletePostMutationResolver $payloadableDeletePostMutationResolver = null;
    protected final function getPayloadableDeletePostMutationResolver() : \PoPCMSSchema\PostMutations\MutationResolvers\PayloadableDeletePostMutationResolver
    {
        if ($this->payloadableDeletePostMutationResolver === null) {
            /** @var PayloadableDeletePostMutationResolver */
            $payloadableDeletePostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostMutations\MutationResolvers\PayloadableDeletePostMutationResolver::class);
            $this->payloadableDeletePostMutationResolver = $payloadableDeletePostMutationResolver;
        }
        return $this->payloadableDeletePostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeletePostMutationResolver();
    }
}
