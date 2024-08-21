<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdatePostTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermMutationResolver|null
     */
    private $payloadableUpdatePostTagTermMutationResolver;
    public final function setPayloadableUpdatePostTagTermMutationResolver(\PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermMutationResolver $payloadableUpdatePostTagTermMutationResolver) : void
    {
        $this->payloadableUpdatePostTagTermMutationResolver = $payloadableUpdatePostTagTermMutationResolver;
    }
    protected final function getPayloadableUpdatePostTagTermMutationResolver() : \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermMutationResolver
    {
        if ($this->payloadableUpdatePostTagTermMutationResolver === null) {
            /** @var PayloadableUpdatePostTagTermMutationResolver */
            $payloadableUpdatePostTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableUpdatePostTagTermMutationResolver::class);
            $this->payloadableUpdatePostTagTermMutationResolver = $payloadableUpdatePostTagTermMutationResolver;
        }
        return $this->payloadableUpdatePostTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdatePostTagTermMutationResolver();
    }
}
