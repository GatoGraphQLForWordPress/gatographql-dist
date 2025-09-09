<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateCategoryTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableUpdateCategoryTermMetaMutationResolver $payloadableUpdateCategoryTermMetaMutationResolver = null;
    protected final function getPayloadableUpdateCategoryTermMetaMutationResolver() : \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableUpdateCategoryTermMetaMutationResolver
    {
        if ($this->payloadableUpdateCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableUpdateCategoryTermMetaMutationResolver */
            $payloadableUpdateCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableUpdateCategoryTermMetaMutationResolver::class);
            $this->payloadableUpdateCategoryTermMetaMutationResolver = $payloadableUpdateCategoryTermMetaMutationResolver;
        }
        return $this->payloadableUpdateCategoryTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateCategoryTermMetaMutationResolver();
    }
}
