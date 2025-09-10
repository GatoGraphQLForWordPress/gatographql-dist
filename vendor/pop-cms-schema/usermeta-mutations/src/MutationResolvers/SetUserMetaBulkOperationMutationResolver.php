<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class SetUserMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\UserMetaMutations\MutationResolvers\SetUserMetaMutationResolver $setUserMetaMutationResolver = null;
    protected final function getSetUserMetaMutationResolver() : \PoPCMSSchema\UserMetaMutations\MutationResolvers\SetUserMetaMutationResolver
    {
        if ($this->setUserMetaMutationResolver === null) {
            /** @var SetUserMetaMutationResolver */
            $setUserMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\UserMetaMutations\MutationResolvers\SetUserMetaMutationResolver::class);
            $this->setUserMetaMutationResolver = $setUserMetaMutationResolver;
        }
        return $this->setUserMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetUserMetaMutationResolver();
    }
}
