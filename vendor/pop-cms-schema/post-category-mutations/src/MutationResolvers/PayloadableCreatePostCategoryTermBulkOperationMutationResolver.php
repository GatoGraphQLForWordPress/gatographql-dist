<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreatePostCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableCreatePostCategoryTermMutationResolver $payloadableCreatePostCategoryTermMutationResolver = null;
    protected final function getPayloadableCreatePostCategoryTermMutationResolver() : \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableCreatePostCategoryTermMutationResolver
    {
        if ($this->payloadableCreatePostCategoryTermMutationResolver === null) {
            /** @var PayloadableCreatePostCategoryTermMutationResolver */
            $payloadableCreatePostCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableCreatePostCategoryTermMutationResolver::class);
            $this->payloadableCreatePostCategoryTermMutationResolver = $payloadableCreatePostCategoryTermMutationResolver;
        }
        return $this->payloadableCreatePostCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreatePostCategoryTermMutationResolver();
    }
}
