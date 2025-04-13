<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteTagTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableDeleteTagTermMetaMutationResolver|null
     */
    private $payloadableDeleteTagTermMetaMutationResolver;
    protected final function getPayloadableDeleteTagTermMetaMutationResolver() : \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableDeleteTagTermMetaMutationResolver
    {
        if ($this->payloadableDeleteTagTermMetaMutationResolver === null) {
            /** @var PayloadableDeleteTagTermMetaMutationResolver */
            $payloadableDeleteTagTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableDeleteTagTermMetaMutationResolver::class);
            $this->payloadableDeleteTagTermMetaMutationResolver = $payloadableDeleteTagTermMetaMutationResolver;
        }
        return $this->payloadableDeleteTagTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteTagTermMetaMutationResolver();
    }
}
