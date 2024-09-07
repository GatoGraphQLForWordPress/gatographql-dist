<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreateGenericCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableCreateGenericCategoryTermMutationResolver|null
     */
    private $payloadableCreateGenericCategoryTermMutationResolver;
    public final function setPayloadableCreateGenericCategoryTermMutationResolver(\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableCreateGenericCategoryTermMutationResolver $payloadableCreateGenericCategoryTermMutationResolver) : void
    {
        $this->payloadableCreateGenericCategoryTermMutationResolver = $payloadableCreateGenericCategoryTermMutationResolver;
    }
    protected final function getPayloadableCreateGenericCategoryTermMutationResolver() : \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableCreateGenericCategoryTermMutationResolver
    {
        if ($this->payloadableCreateGenericCategoryTermMutationResolver === null) {
            /** @var PayloadableCreateGenericCategoryTermMutationResolver */
            $payloadableCreateGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableCreateGenericCategoryTermMutationResolver::class);
            $this->payloadableCreateGenericCategoryTermMutationResolver = $payloadableCreateGenericCategoryTermMutationResolver;
        }
        return $this->payloadableCreateGenericCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreateGenericCategoryTermMutationResolver();
    }
}
