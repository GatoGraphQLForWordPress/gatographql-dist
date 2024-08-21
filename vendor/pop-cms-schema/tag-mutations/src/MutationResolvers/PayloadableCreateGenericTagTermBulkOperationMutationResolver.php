<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreateGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\MutationResolvers\PayloadableCreateGenericTagTermMutationResolver|null
     */
    private $payloadableCreateGenericTagTermMutationResolver;
    public final function setPayloadableCreateGenericTagTermMutationResolver(\PoPCMSSchema\TagMutations\MutationResolvers\PayloadableCreateGenericTagTermMutationResolver $payloadableCreateGenericTagTermMutationResolver) : void
    {
        $this->payloadableCreateGenericTagTermMutationResolver = $payloadableCreateGenericTagTermMutationResolver;
    }
    protected final function getPayloadableCreateGenericTagTermMutationResolver() : \PoPCMSSchema\TagMutations\MutationResolvers\PayloadableCreateGenericTagTermMutationResolver
    {
        if ($this->payloadableCreateGenericTagTermMutationResolver === null) {
            /** @var PayloadableCreateGenericTagTermMutationResolver */
            $payloadableCreateGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMutations\MutationResolvers\PayloadableCreateGenericTagTermMutationResolver::class);
            $this->payloadableCreateGenericTagTermMutationResolver = $payloadableCreateGenericTagTermMutationResolver;
        }
        return $this->payloadableCreateGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreateGenericTagTermMutationResolver();
    }
}
