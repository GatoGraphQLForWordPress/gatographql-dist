<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdatePostCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableUpdatePostCategoryTermMutationResolver $payloadableUpdatePostCategoryTermMutationResolver = null;
    protected final function getPayloadableUpdatePostCategoryTermMutationResolver() : \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableUpdatePostCategoryTermMutationResolver
    {
        if ($this->payloadableUpdatePostCategoryTermMutationResolver === null) {
            /** @var PayloadableUpdatePostCategoryTermMutationResolver */
            $payloadableUpdatePostCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableUpdatePostCategoryTermMutationResolver::class);
            $this->payloadableUpdatePostCategoryTermMutationResolver = $payloadableUpdatePostCategoryTermMutationResolver;
        }
        return $this->payloadableUpdatePostCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdatePostCategoryTermMutationResolver();
    }
}
