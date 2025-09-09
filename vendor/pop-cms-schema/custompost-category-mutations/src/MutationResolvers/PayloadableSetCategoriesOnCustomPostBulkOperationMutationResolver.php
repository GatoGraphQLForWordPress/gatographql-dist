<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetCategoriesOnCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnCustomPostMutationResolver $payloadableSetCategoriesOnCustomPostMutationResolver = null;
    protected final function getPayloadableSetCategoriesOnCustomPostMutationResolver() : \PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnCustomPostMutationResolver
    {
        if ($this->payloadableSetCategoriesOnCustomPostMutationResolver === null) {
            /** @var PayloadableSetCategoriesOnCustomPostMutationResolver */
            $payloadableSetCategoriesOnCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnCustomPostMutationResolver::class);
            $this->payloadableSetCategoriesOnCustomPostMutationResolver = $payloadableSetCategoriesOnCustomPostMutationResolver;
        }
        return $this->payloadableSetCategoriesOnCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetCategoriesOnCustomPostMutationResolver();
    }
}
