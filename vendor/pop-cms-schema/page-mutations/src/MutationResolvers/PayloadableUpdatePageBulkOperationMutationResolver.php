<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdatePageBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\PayloadableUpdatePageMutationResolver|null
     */
    private $payloadableUpdatePageMutationResolver;
    protected final function getPayloadableUpdatePageMutationResolver() : \PoPCMSSchema\PageMutations\MutationResolvers\PayloadableUpdatePageMutationResolver
    {
        if ($this->payloadableUpdatePageMutationResolver === null) {
            /** @var PayloadableUpdatePageMutationResolver */
            $payloadableUpdatePageMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PageMutations\MutationResolvers\PayloadableUpdatePageMutationResolver::class);
            $this->payloadableUpdatePageMutationResolver = $payloadableUpdatePageMutationResolver;
        }
        return $this->payloadableUpdatePageMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdatePageMutationResolver();
    }
}
