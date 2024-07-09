<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableRemoveFeaturedImageFromCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver|null
     */
    private $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
    public final function setPayloadableRemoveFeaturedImageFromCustomPostMutationResolver(\PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver $payloadableRemoveFeaturedImageFromCustomPostMutationResolver) : void
    {
        $this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver = $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
    }
    protected final function getPayloadableRemoveFeaturedImageFromCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver
    {
        if ($this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver === null) {
            /** @var PayloadableRemoveFeaturedImageFromCustomPostMutationResolver */
            $payloadableRemoveFeaturedImageFromCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableRemoveFeaturedImageFromCustomPostMutationResolver::class);
            $this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver = $payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
        }
        return $this->payloadableRemoveFeaturedImageFromCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableRemoveFeaturedImageFromCustomPostMutationResolver();
    }
}
