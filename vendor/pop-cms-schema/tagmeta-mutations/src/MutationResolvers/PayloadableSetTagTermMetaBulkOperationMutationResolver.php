<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetTagTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaMutationResolver $payloadableSetTagTermMetaMutationResolver = null;
    protected final function getPayloadableSetTagTermMetaMutationResolver() : \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaMutationResolver
    {
        if ($this->payloadableSetTagTermMetaMutationResolver === null) {
            /** @var PayloadableSetTagTermMetaMutationResolver */
            $payloadableSetTagTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaMutationResolver::class);
            $this->payloadableSetTagTermMetaMutationResolver = $payloadableSetTagTermMetaMutationResolver;
        }
        return $this->payloadableSetTagTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetTagTermMetaMutationResolver();
    }
}
