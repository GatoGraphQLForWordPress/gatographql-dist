<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreateMediaItemBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver $payloadableCreateMediaItemMutationResolver = null;
    protected final function getPayloadableCreateMediaItemMutationResolver() : \PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver
    {
        if ($this->payloadableCreateMediaItemMutationResolver === null) {
            /** @var PayloadableCreateMediaItemMutationResolver */
            $payloadableCreateMediaItemMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver::class);
            $this->payloadableCreateMediaItemMutationResolver = $payloadableCreateMediaItemMutationResolver;
        }
        return $this->payloadableCreateMediaItemMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreateMediaItemMutationResolver();
    }
}
