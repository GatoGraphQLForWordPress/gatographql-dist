<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateGenericCategoryTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermMutationResolver|null
     */
    private $payloadableUpdateGenericCategoryTermMutationResolver;
    public final function setPayloadableUpdateGenericCategoryTermMutationResolver(\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermMutationResolver $payloadableUpdateGenericCategoryTermMutationResolver) : void
    {
        $this->payloadableUpdateGenericCategoryTermMutationResolver = $payloadableUpdateGenericCategoryTermMutationResolver;
    }
    protected final function getPayloadableUpdateGenericCategoryTermMutationResolver() : \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermMutationResolver
    {
        if ($this->payloadableUpdateGenericCategoryTermMutationResolver === null) {
            /** @var PayloadableUpdateGenericCategoryTermMutationResolver */
            $payloadableUpdateGenericCategoryTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableUpdateGenericCategoryTermMutationResolver::class);
            $this->payloadableUpdateGenericCategoryTermMutationResolver = $payloadableUpdateGenericCategoryTermMutationResolver;
        }
        return $this->payloadableUpdateGenericCategoryTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateGenericCategoryTermMutationResolver();
    }
}
