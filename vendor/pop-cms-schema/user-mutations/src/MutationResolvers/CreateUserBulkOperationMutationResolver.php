<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreateUserBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMutations\MutationResolvers\CreateUserMutationResolver $createUserMutationResolver = null;
    protected final function getCreateUserMutationResolver() : \PoPCMSSchema\UserMutations\MutationResolvers\CreateUserMutationResolver
    {
        if ($this->createUserMutationResolver === null) {
            /** @var CreateUserMutationResolver */
            $createUserMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMutations\MutationResolvers\CreateUserMutationResolver::class);
            $this->createUserMutationResolver = $createUserMutationResolver;
        }
        return $this->createUserMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreateUserMutationResolver();
    }
}
