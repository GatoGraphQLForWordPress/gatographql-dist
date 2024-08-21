<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeletePostCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermMutationResolver|null
     */
    private $payloadableDeletePostCategoryTermMutationResolver;
    public final function setPayloadableDeletePostCategoryTermMutationResolver(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermMutationResolver $payloadableDeletePostCategoryTermMutationResolver) : void
    {
        $this->payloadableDeletePostCategoryTermMutationResolver = $payloadableDeletePostCategoryTermMutationResolver;
    }
    protected final function getPayloadableDeletePostCategoryTermMutationResolver() : \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermMutationResolver
    {
        if ($this->payloadableDeletePostCategoryTermMutationResolver === null) {
            /** @var PayloadableDeletePostCategoryTermMutationResolver */
            $payloadableDeletePostCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableDeletePostCategoryTermMutationResolver::class);
            $this->payloadableDeletePostCategoryTermMutationResolver = $payloadableDeletePostCategoryTermMutationResolver;
        }
        return $this->payloadableDeletePostCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeletePostCategoryTermMutationResolver();
    }
}
