<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreateGenericCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostMutationResolver|null
     */
    private $payloadableCreateGenericCustomPostMutationResolver;
    public final function setPayloadableCreateGenericCustomPostMutationResolver(\PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostMutationResolver $payloadableCreateGenericCustomPostMutationResolver) : void
    {
        $this->payloadableCreateGenericCustomPostMutationResolver = $payloadableCreateGenericCustomPostMutationResolver;
    }
    protected final function getPayloadableCreateGenericCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostMutationResolver
    {
        if ($this->payloadableCreateGenericCustomPostMutationResolver === null) {
            /** @var PayloadableCreateGenericCustomPostMutationResolver */
            $payloadableCreateGenericCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMutations\MutationResolvers\PayloadableCreateGenericCustomPostMutationResolver::class);
            $this->payloadableCreateGenericCustomPostMutationResolver = $payloadableCreateGenericCustomPostMutationResolver;
        }
        return $this->payloadableCreateGenericCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreateGenericCustomPostMutationResolver();
    }
}
