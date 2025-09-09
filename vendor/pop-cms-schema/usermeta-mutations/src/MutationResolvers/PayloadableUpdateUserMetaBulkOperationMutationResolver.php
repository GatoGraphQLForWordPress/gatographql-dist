<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateUserMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableUpdateUserMetaMutationResolver $payloadableUpdateUserMetaMutationResolver = null;
    protected final function getPayloadableUpdateUserMetaMutationResolver() : \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableUpdateUserMetaMutationResolver
    {
        if ($this->payloadableUpdateUserMetaMutationResolver === null) {
            /** @var PayloadableUpdateUserMetaMutationResolver */
            $payloadableUpdateUserMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableUpdateUserMetaMutationResolver::class);
            $this->payloadableUpdateUserMetaMutationResolver = $payloadableUpdateUserMetaMutationResolver;
        }
        return $this->payloadableUpdateUserMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateUserMetaMutationResolver();
    }
}
