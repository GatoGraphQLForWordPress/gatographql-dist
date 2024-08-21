<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeletePostTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermMutationResolver|null
     */
    private $payloadableDeletePostTagTermMutationResolver;
    public final function setPayloadableDeletePostTagTermMutationResolver(\PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermMutationResolver $payloadableDeletePostTagTermMutationResolver) : void
    {
        $this->payloadableDeletePostTagTermMutationResolver = $payloadableDeletePostTagTermMutationResolver;
    }
    protected final function getPayloadableDeletePostTagTermMutationResolver() : \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermMutationResolver
    {
        if ($this->payloadableDeletePostTagTermMutationResolver === null) {
            /** @var PayloadableDeletePostTagTermMutationResolver */
            $payloadableDeletePostTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableDeletePostTagTermMutationResolver::class);
            $this->payloadableDeletePostTagTermMutationResolver = $payloadableDeletePostTagTermMutationResolver;
        }
        return $this->payloadableDeletePostTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeletePostTagTermMutationResolver();
    }
}
