<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableDeleteGenericTagTermMutationResolver|null
     */
    private $payloadableDeleteGenericTagTermMutationResolver;
    public final function setPayloadableDeleteGenericTagTermMutationResolver(\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableDeleteGenericTagTermMutationResolver $payloadableDeleteGenericTagTermMutationResolver) : void
    {
        $this->payloadableDeleteGenericTagTermMutationResolver = $payloadableDeleteGenericTagTermMutationResolver;
    }
    protected final function getPayloadableDeleteGenericTagTermMutationResolver() : \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableDeleteGenericTagTermMutationResolver
    {
        if ($this->payloadableDeleteGenericTagTermMutationResolver === null) {
            /** @var PayloadableDeleteGenericTagTermMutationResolver */
            $payloadableDeleteGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableDeleteGenericTagTermMutationResolver::class);
            $this->payloadableDeleteGenericTagTermMutationResolver = $payloadableDeleteGenericTagTermMutationResolver;
        }
        return $this->payloadableDeleteGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteGenericTagTermMutationResolver();
    }
}
