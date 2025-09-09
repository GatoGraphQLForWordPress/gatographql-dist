<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteUserMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMetaMutations\MutationResolvers\DeleteUserMetaMutationResolver $deleteUserMetaMutationResolver = null;
    protected final function getDeleteUserMetaMutationResolver() : \PoPCMSSchema\UserMetaMutations\MutationResolvers\DeleteUserMetaMutationResolver
    {
        if ($this->deleteUserMetaMutationResolver === null) {
            /** @var DeleteUserMetaMutationResolver */
            $deleteUserMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMetaMutations\MutationResolvers\DeleteUserMetaMutationResolver::class);
            $this->deleteUserMetaMutationResolver = $deleteUserMetaMutationResolver;
        }
        return $this->deleteUserMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteUserMetaMutationResolver();
    }
}
