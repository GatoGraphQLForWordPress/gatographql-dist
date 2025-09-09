<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetCategoryTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableSetCategoryTermMetaMutationResolver $payloadableSetCategoryTermMetaMutationResolver = null;
    protected final function getPayloadableSetCategoryTermMetaMutationResolver() : \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableSetCategoryTermMetaMutationResolver
    {
        if ($this->payloadableSetCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableSetCategoryTermMetaMutationResolver */
            $payloadableSetCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableSetCategoryTermMetaMutationResolver::class);
            $this->payloadableSetCategoryTermMetaMutationResolver = $payloadableSetCategoryTermMetaMutationResolver;
        }
        return $this->payloadableSetCategoryTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetCategoryTermMetaMutationResolver();
    }
}
