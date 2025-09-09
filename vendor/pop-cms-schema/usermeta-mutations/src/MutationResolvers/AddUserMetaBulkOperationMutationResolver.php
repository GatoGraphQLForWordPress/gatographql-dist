<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class AddUserMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMetaMutations\MutationResolvers\AddUserMetaMutationResolver $addUserMetaMutationResolver = null;
    protected final function getAddUserMetaMutationResolver() : \PoPCMSSchema\UserMetaMutations\MutationResolvers\AddUserMetaMutationResolver
    {
        if ($this->addUserMetaMutationResolver === null) {
            /** @var AddUserMetaMutationResolver */
            $addUserMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMetaMutations\MutationResolvers\AddUserMetaMutationResolver::class);
            $this->addUserMetaMutationResolver = $addUserMetaMutationResolver;
        }
        return $this->addUserMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getAddUserMetaMutationResolver();
    }
}
