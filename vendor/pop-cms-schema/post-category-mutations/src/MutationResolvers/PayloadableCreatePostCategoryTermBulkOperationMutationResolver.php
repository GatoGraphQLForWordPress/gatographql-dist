<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreatePostCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableCreatePostCategoryTermMutationResolver|null
     */
    private $payloadableCreatePostCategoryTermMutationResolver;
    public final function setPayloadableCreatePostCategoryTermMutationResolver(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableCreatePostCategoryTermMutationResolver $payloadableCreatePostCategoryTermMutationResolver) : void
    {
        $this->payloadableCreatePostCategoryTermMutationResolver = $payloadableCreatePostCategoryTermMutationResolver;
    }
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
