<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateTagTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableUpdateTagTermMetaMutationResolver $payloadableUpdateTagTermMetaMutationResolver = null;
    protected final function getPayloadableUpdateTagTermMetaMutationResolver() : \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableUpdateTagTermMetaMutationResolver
    {
        if ($this->payloadableUpdateTagTermMetaMutationResolver === null) {
            /** @var PayloadableUpdateTagTermMetaMutationResolver */
            $payloadableUpdateTagTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableUpdateTagTermMetaMutationResolver::class);
            $this->payloadableUpdateTagTermMetaMutationResolver = $payloadableUpdateTagTermMetaMutationResolver;
        }
        return $this->payloadableUpdateTagTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateTagTermMetaMutationResolver();
    }
}
