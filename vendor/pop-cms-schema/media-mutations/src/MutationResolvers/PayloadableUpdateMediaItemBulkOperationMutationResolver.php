<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateMediaItemBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableUpdateMediaItemMutationResolver $payloadableUpdateMediaItemMutationResolver = null;
    protected final function getPayloadableUpdateMediaItemMutationResolver() : \PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableUpdateMediaItemMutationResolver
    {
        if ($this->payloadableUpdateMediaItemMutationResolver === null) {
            /** @var PayloadableUpdateMediaItemMutationResolver */
            $payloadableUpdateMediaItemMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableUpdateMediaItemMutationResolver::class);
            $this->payloadableUpdateMediaItemMutationResolver = $payloadableUpdateMediaItemMutationResolver;
        }
        return $this->payloadableUpdateMediaItemMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateMediaItemMutationResolver();
    }
}
