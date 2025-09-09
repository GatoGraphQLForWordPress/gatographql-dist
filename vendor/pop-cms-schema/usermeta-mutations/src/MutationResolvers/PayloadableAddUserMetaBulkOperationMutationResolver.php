<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableAddUserMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableAddUserMetaMutationResolver $payloadableAddUserMetaMutationResolver = null;
    protected final function getPayloadableAddUserMetaMutationResolver() : \PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableAddUserMetaMutationResolver
    {
        if ($this->payloadableAddUserMetaMutationResolver === null) {
            /** @var PayloadableAddUserMetaMutationResolver */
            $payloadableAddUserMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMetaMutations\MutationResolvers\PayloadableAddUserMetaMutationResolver::class);
            $this->payloadableAddUserMetaMutationResolver = $payloadableAddUserMetaMutationResolver;
        }
        return $this->payloadableAddUserMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableAddUserMetaMutationResolver();
    }
}
