<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreatePostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostMutations\MutationResolvers\PayloadableCreatePostMutationResolver $payloadableCreatePostMutationResolver = null;
    protected final function getPayloadableCreatePostMutationResolver() : \PoPCMSSchema\PostMutations\MutationResolvers\PayloadableCreatePostMutationResolver
    {
        if ($this->payloadableCreatePostMutationResolver === null) {
            /** @var PayloadableCreatePostMutationResolver */
            $payloadableCreatePostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostMutations\MutationResolvers\PayloadableCreatePostMutationResolver::class);
            $this->payloadableCreatePostMutationResolver = $payloadableCreatePostMutationResolver;
        }
        return $this->payloadableCreatePostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreatePostMutationResolver();
    }
}
