<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateGenericCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostMutationResolver|null
     */
    private $payloadableUpdateGenericCustomPostMutationResolver;
    protected final function getPayloadableUpdateGenericCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostMutationResolver
    {
        if ($this->payloadableUpdateGenericCustomPostMutationResolver === null) {
            /** @var PayloadableUpdateGenericCustomPostMutationResolver */
            $payloadableUpdateGenericCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableUpdateGenericCustomPostMutationResolver::class);
            $this->payloadableUpdateGenericCustomPostMutationResolver = $payloadableUpdateGenericCustomPostMutationResolver;
        }
        return $this->payloadableUpdateGenericCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateGenericCustomPostMutationResolver();
    }
}
