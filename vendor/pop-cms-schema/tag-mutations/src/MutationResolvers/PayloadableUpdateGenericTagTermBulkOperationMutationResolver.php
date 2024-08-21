<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver|null
     */
    private $payloadableUpdateGenericTagTermMutationResolver;
    public final function setPayloadableUpdateGenericTagTermMutationResolver(\PoPCMSSchema\TagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver $payloadableUpdateGenericTagTermMutationResolver) : void
    {
        $this->payloadableUpdateGenericTagTermMutationResolver = $payloadableUpdateGenericTagTermMutationResolver;
    }
    protected final function getPayloadableUpdateGenericTagTermMutationResolver() : \PoPCMSSchema\TagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver
    {
        if ($this->payloadableUpdateGenericTagTermMutationResolver === null) {
            /** @var PayloadableUpdateGenericTagTermMutationResolver */
            $payloadableUpdateGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver::class);
            $this->payloadableUpdateGenericTagTermMutationResolver = $payloadableUpdateGenericTagTermMutationResolver;
        }
        return $this->payloadableUpdateGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateGenericTagTermMutationResolver();
    }
}
