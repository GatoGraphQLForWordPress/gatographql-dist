<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteGenericCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableDeleteGenericCustomPostMutationResolver $payloadableDeleteGenericCustomPostMutationResolver = null;
    protected final function getPayloadableDeleteGenericCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableDeleteGenericCustomPostMutationResolver
    {
        if ($this->payloadableDeleteGenericCustomPostMutationResolver === null) {
            /** @var PayloadableDeleteGenericCustomPostMutationResolver */
            $payloadableDeleteGenericCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableDeleteGenericCustomPostMutationResolver::class);
            $this->payloadableDeleteGenericCustomPostMutationResolver = $payloadableDeleteGenericCustomPostMutationResolver;
        }
        return $this->payloadableDeleteGenericCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteGenericCustomPostMutationResolver();
    }
}
