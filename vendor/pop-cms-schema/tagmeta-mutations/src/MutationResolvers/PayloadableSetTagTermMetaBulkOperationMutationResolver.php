<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetTagTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableSetTagTermMetaMutationResolver|null
     */
    private $payloadableSetTagTermMetaMutationResolver;
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
