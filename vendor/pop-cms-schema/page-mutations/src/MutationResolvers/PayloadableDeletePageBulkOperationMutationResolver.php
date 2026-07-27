<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeletePageBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PageMutations\MutationResolvers\PayloadableDeletePageMutationResolver $payloadableDeletePageMutationResolver = null;
    protected final function getPayloadableDeletePageMutationResolver() : \PoPCMSSchema\PageMutations\MutationResolvers\PayloadableDeletePageMutationResolver
    {
        if ($this->payloadableDeletePageMutationResolver === null) {
            /** @var PayloadableDeletePageMutationResolver */
            $payloadableDeletePageMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PageMutations\MutationResolvers\PayloadableDeletePageMutationResolver::class);
            $this->payloadableDeletePageMutationResolver = $payloadableDeletePageMutationResolver;
        }
        return $this->payloadableDeletePageMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeletePageMutationResolver();
    }
}
