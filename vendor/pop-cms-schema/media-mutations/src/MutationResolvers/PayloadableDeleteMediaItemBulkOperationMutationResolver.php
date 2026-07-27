<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteMediaItemBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableDeleteMediaItemMutationResolver $payloadableDeleteMediaItemMutationResolver = null;
    protected final function getPayloadableDeleteMediaItemMutationResolver() : \PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableDeleteMediaItemMutationResolver
    {
        if ($this->payloadableDeleteMediaItemMutationResolver === null) {
            /** @var PayloadableDeleteMediaItemMutationResolver */
            $payloadableDeleteMediaItemMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableDeleteMediaItemMutationResolver::class);
            $this->payloadableDeleteMediaItemMutationResolver = $payloadableDeleteMediaItemMutationResolver;
        }
        return $this->payloadableDeleteMediaItemMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteMediaItemMutationResolver();
    }
}
