<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteCategoryTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableDeleteCategoryTermMetaMutationResolver $payloadableDeleteCategoryTermMetaMutationResolver = null;
    protected final function getPayloadableDeleteCategoryTermMetaMutationResolver() : \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableDeleteCategoryTermMetaMutationResolver
    {
        if ($this->payloadableDeleteCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableDeleteCategoryTermMetaMutationResolver */
            $payloadableDeleteCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableDeleteCategoryTermMetaMutationResolver::class);
            $this->payloadableDeleteCategoryTermMetaMutationResolver = $payloadableDeleteCategoryTermMetaMutationResolver;
        }
        return $this->payloadableDeleteCategoryTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteCategoryTermMetaMutationResolver();
    }
}
