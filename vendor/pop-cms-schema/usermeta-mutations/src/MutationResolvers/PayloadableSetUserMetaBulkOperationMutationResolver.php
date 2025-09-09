<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetUserMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableSetUserMetaMutationResolver $payloadableSetUserMetaMutationResolver = null;
    protected final function getPayloadableSetUserMetaMutationResolver() : \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableSetUserMetaMutationResolver
    {
        if ($this->payloadableSetUserMetaMutationResolver === null) {
            /** @var PayloadableSetUserMetaMutationResolver */
            $payloadableSetUserMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableSetUserMetaMutationResolver::class);
            $this->payloadableSetUserMetaMutationResolver = $payloadableSetUserMetaMutationResolver;
        }
        return $this->payloadableSetUserMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetUserMetaMutationResolver();
    }
}
