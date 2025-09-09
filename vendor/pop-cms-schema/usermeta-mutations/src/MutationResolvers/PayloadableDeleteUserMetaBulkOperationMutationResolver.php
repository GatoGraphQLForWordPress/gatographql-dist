<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteUserMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableDeleteUserMetaMutationResolver $payloadableDeleteUserMetaMutationResolver = null;
    protected final function getPayloadableDeleteUserMetaMutationResolver() : \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableDeleteUserMetaMutationResolver
    {
        if ($this->payloadableDeleteUserMetaMutationResolver === null) {
            /** @var PayloadableDeleteUserMetaMutationResolver */
            $payloadableDeleteUserMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableDeleteUserMetaMutationResolver::class);
            $this->payloadableDeleteUserMetaMutationResolver = $payloadableDeleteUserMetaMutationResolver;
        }
        return $this->payloadableDeleteUserMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteUserMetaMutationResolver();
    }
}
