<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetFeaturedImageOnCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostMutationResolver $payloadableSetFeaturedImageOnCustomPostMutationResolver = null;
    protected final function getPayloadableSetFeaturedImageOnCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostMutationResolver
    {
        if ($this->payloadableSetFeaturedImageOnCustomPostMutationResolver === null) {
            /** @var PayloadableSetFeaturedImageOnCustomPostMutationResolver */
            $payloadableSetFeaturedImageOnCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\PayloadableSetFeaturedImageOnCustomPostMutationResolver::class);
            $this->payloadableSetFeaturedImageOnCustomPostMutationResolver = $payloadableSetFeaturedImageOnCustomPostMutationResolver;
        }
        return $this->payloadableSetFeaturedImageOnCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetFeaturedImageOnCustomPostMutationResolver();
    }
}
