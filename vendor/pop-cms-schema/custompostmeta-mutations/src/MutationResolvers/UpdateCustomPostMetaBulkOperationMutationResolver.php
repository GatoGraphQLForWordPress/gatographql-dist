<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateCustomPostMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\UpdateCustomPostMetaMutationResolver $updateCustomPostMetaMutationResolver = null;
    protected final function getUpdateCustomPostMetaMutationResolver() : \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\UpdateCustomPostMetaMutationResolver
    {
        if ($this->updateCustomPostMetaMutationResolver === null) {
            /** @var UpdateCustomPostMetaMutationResolver */
            $updateCustomPostMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\UpdateCustomPostMetaMutationResolver::class);
            $this->updateCustomPostMetaMutationResolver = $updateCustomPostMetaMutationResolver;
        }
        return $this->updateCustomPostMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateCustomPostMetaMutationResolver();
    }
}
