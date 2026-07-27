<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteUserBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMutations\MutationResolvers\PayloadableDeleteUserMutationResolver $payloadableDeleteUserMutationResolver = null;
    protected final function getPayloadableDeleteUserMutationResolver() : \PoPCMSSchema\UserMutations\MutationResolvers\PayloadableDeleteUserMutationResolver
    {
        if ($this->payloadableDeleteUserMutationResolver === null) {
            /** @var PayloadableDeleteUserMutationResolver */
            $payloadableDeleteUserMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMutations\MutationResolvers\PayloadableDeleteUserMutationResolver::class);
            $this->payloadableDeleteUserMutationResolver = $payloadableDeleteUserMutationResolver;
        }
        return $this->payloadableDeleteUserMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteUserMutationResolver();
    }
}
