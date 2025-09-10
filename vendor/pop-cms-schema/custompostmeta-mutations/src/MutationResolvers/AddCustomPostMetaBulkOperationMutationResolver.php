<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class AddCustomPostMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\AddCustomPostMetaMutationResolver $addCustomPostMetaMutationResolver = null;
    protected final function getAddCustomPostMetaMutationResolver() : \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\AddCustomPostMetaMutationResolver
    {
        if ($this->addCustomPostMetaMutationResolver === null) {
            /** @var AddCustomPostMetaMutationResolver */
            $addCustomPostMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\AddCustomPostMetaMutationResolver::class);
            $this->addCustomPostMetaMutationResolver = $addCustomPostMetaMutationResolver;
        }
        return $this->addCustomPostMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getAddCustomPostMetaMutationResolver();
    }
}
