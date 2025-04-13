<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteCustomPostMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\DeleteCustomPostMetaMutationResolver|null
     */
    private $deleteCustomPostMetaMutationResolver;
    protected final function getDeleteCustomPostMetaMutationResolver() : \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\DeleteCustomPostMetaMutationResolver
    {
        if ($this->deleteCustomPostMetaMutationResolver === null) {
            /** @var DeleteCustomPostMetaMutationResolver */
            $deleteCustomPostMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\DeleteCustomPostMetaMutationResolver::class);
            $this->deleteCustomPostMetaMutationResolver = $deleteCustomPostMetaMutationResolver;
        }
        return $this->deleteCustomPostMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteCustomPostMetaMutationResolver();
    }
}
