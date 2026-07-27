<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteUserBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMutations\MutationResolvers\DeleteUserMutationResolver $deleteUserMutationResolver = null;
    protected final function getDeleteUserMutationResolver() : \PoPCMSSchema\UserMutations\MutationResolvers\DeleteUserMutationResolver
    {
        if ($this->deleteUserMutationResolver === null) {
            /** @var DeleteUserMutationResolver */
            $deleteUserMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMutations\MutationResolvers\DeleteUserMutationResolver::class);
            $this->deleteUserMutationResolver = $deleteUserMutationResolver;
        }
        return $this->deleteUserMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteUserMutationResolver();
    }
}
