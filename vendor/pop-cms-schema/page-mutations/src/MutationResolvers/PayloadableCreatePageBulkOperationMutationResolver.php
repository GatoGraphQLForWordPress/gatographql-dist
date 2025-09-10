<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreatePageBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PageMutations\MutationResolvers\PayloadableCreatePageMutationResolver $payloadableCreatePageMutationResolver = null;
    protected final function getPayloadableCreatePageMutationResolver() : \PoPCMSSchema\PageMutations\MutationResolvers\PayloadableCreatePageMutationResolver
    {
        if ($this->payloadableCreatePageMutationResolver === null) {
            /** @var PayloadableCreatePageMutationResolver */
            $payloadableCreatePageMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PageMutations\MutationResolvers\PayloadableCreatePageMutationResolver::class);
            $this->payloadableCreatePageMutationResolver = $payloadableCreatePageMutationResolver;
        }
        return $this->payloadableCreatePageMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreatePageMutationResolver();
    }
}
