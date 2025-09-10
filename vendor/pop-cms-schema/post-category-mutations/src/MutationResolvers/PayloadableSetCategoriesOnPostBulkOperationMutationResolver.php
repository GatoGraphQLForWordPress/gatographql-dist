<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetCategoriesOnPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnPostMutationResolver $payloadableSetCategoriesOnPostMutationResolver = null;
    protected final function getPayloadableSetCategoriesOnPostMutationResolver() : \PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnPostMutationResolver
    {
        if ($this->payloadableSetCategoriesOnPostMutationResolver === null) {
            /** @var PayloadableSetCategoriesOnPostMutationResolver */
            $payloadableSetCategoriesOnPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostCategoryMutations\MutationResolvers\PayloadableSetCategoriesOnPostMutationResolver::class);
            $this->payloadableSetCategoriesOnPostMutationResolver = $payloadableSetCategoriesOnPostMutationResolver;
        }
        return $this->payloadableSetCategoriesOnPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetCategoriesOnPostMutationResolver();
    }
}
