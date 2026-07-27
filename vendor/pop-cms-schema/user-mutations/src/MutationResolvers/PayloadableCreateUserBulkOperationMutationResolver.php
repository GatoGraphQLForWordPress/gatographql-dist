<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreateUserBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMutations\MutationResolvers\PayloadableCreateUserMutationResolver $payloadableCreateUserMutationResolver = null;
    protected final function getPayloadableCreateUserMutationResolver() : \PoPCMSSchema\UserMutations\MutationResolvers\PayloadableCreateUserMutationResolver
    {
        if ($this->payloadableCreateUserMutationResolver === null) {
            /** @var PayloadableCreateUserMutationResolver */
            $payloadableCreateUserMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMutations\MutationResolvers\PayloadableCreateUserMutationResolver::class);
            $this->payloadableCreateUserMutationResolver = $payloadableCreateUserMutationResolver;
        }
        return $this->payloadableCreateUserMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreateUserMutationResolver();
    }
}
