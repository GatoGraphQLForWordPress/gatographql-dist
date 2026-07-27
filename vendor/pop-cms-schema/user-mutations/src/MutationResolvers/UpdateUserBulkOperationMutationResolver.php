<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateUserBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMutations\MutationResolvers\UpdateUserMutationResolver $updateUserMutationResolver = null;
    protected final function getUpdateUserMutationResolver() : \PoPCMSSchema\UserMutations\MutationResolvers\UpdateUserMutationResolver
    {
        if ($this->updateUserMutationResolver === null) {
            /** @var UpdateUserMutationResolver */
            $updateUserMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMutations\MutationResolvers\UpdateUserMutationResolver::class);
            $this->updateUserMutationResolver = $updateUserMutationResolver;
        }
        return $this->updateUserMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateUserMutationResolver();
    }
}
