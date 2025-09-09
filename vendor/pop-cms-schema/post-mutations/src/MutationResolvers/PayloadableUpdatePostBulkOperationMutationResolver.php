<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdatePostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostMutations\MutationResolvers\PayloadableUpdatePostMutationResolver $payloadableUpdatePostMutationResolver = null;
    protected final function getPayloadableUpdatePostMutationResolver() : \PoPCMSSchema\PostMutations\MutationResolvers\PayloadableUpdatePostMutationResolver
    {
        if ($this->payloadableUpdatePostMutationResolver === null) {
            /** @var PayloadableUpdatePostMutationResolver */
            $payloadableUpdatePostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostMutations\MutationResolvers\PayloadableUpdatePostMutationResolver::class);
            $this->payloadableUpdatePostMutationResolver = $payloadableUpdatePostMutationResolver;
        }
        return $this->payloadableUpdatePostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdatePostMutationResolver();
    }
}
