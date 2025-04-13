<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableAddCategoryTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableAddCategoryTermMetaMutationResolver|null
     */
    private $payloadableAddCategoryTermMetaMutationResolver;
    protected final function getPayloadableAddCategoryTermMetaMutationResolver() : \PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableAddCategoryTermMetaMutationResolver
    {
        if ($this->payloadableAddCategoryTermMetaMutationResolver === null) {
            /** @var PayloadableAddCategoryTermMetaMutationResolver */
            $payloadableAddCategoryTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CategoryMetaMutations\MutationResolvers\PayloadableAddCategoryTermMetaMutationResolver::class);
            $this->payloadableAddCategoryTermMetaMutationResolver = $payloadableAddCategoryTermMetaMutationResolver;
        }
        return $this->payloadableAddCategoryTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableAddCategoryTermMetaMutationResolver();
    }
}
