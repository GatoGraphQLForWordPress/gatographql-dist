<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreateMediaItemBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver|null
     */
    private $payloadableCreateMediaItemMutationResolver;
    public final function setPayloadableCreateMediaItemMutationResolver(\PoPCMSSchema\MediaMutations\MutationResolvers\PayloadableCreateMediaItemMutationResolver $payloadableCreateMediaItemMutationResolver) : void
    {
        $this->payloadableCreateMediaItemMutationResolver = $payloadableCreateMediaItemMutationResolver;
    }
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
