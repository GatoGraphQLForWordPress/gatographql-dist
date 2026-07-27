<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateUserBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMutations\MutationResolvers\PayloadableUpdateUserMutationResolver $payloadableUpdateUserMutationResolver = null;
    protected final function getPayloadableUpdateUserMutationResolver() : \PoPCMSSchema\UserMutations\MutationResolvers\PayloadableUpdateUserMutationResolver
    {
        if ($this->payloadableUpdateUserMutationResolver === null) {
            /** @var PayloadableUpdateUserMutationResolver */
            $payloadableUpdateUserMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMutations\MutationResolvers\PayloadableUpdateUserMutationResolver::class);
            $this->payloadableUpdateUserMutationResolver = $payloadableUpdateUserMutationResolver;
        }
        return $this->payloadableUpdateUserMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateUserMutationResolver();
    }
}
