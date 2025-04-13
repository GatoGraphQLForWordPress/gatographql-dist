<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableAddTagTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableAddTagTermMetaMutationResolver|null
     */
    private $payloadableAddTagTermMetaMutationResolver;
    protected final function getPayloadableAddTagTermMetaMutationResolver() : \PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableAddTagTermMetaMutationResolver
    {
        if ($this->payloadableAddTagTermMetaMutationResolver === null) {
            /** @var PayloadableAddTagTermMetaMutationResolver */
            $payloadableAddTagTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMetaMutations\MutationResolvers\PayloadableAddTagTermMetaMutationResolver::class);
            $this->payloadableAddTagTermMetaMutationResolver = $payloadableAddTagTermMetaMutationResolver;
        }
        return $this->payloadableAddTagTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableAddTagTermMetaMutationResolver();
    }
}
