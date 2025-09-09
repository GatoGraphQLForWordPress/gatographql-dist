<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreateGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableCreateGenericTagTermMutationResolver $payloadableCreateGenericTagTermMutationResolver = null;
    protected final function getPayloadableCreateGenericTagTermMutationResolver() : \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableCreateGenericTagTermMutationResolver
    {
        if ($this->payloadableCreateGenericTagTermMutationResolver === null) {
            /** @var PayloadableCreateGenericTagTermMutationResolver */
            $payloadableCreateGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableCreateGenericTagTermMutationResolver::class);
            $this->payloadableCreateGenericTagTermMutationResolver = $payloadableCreateGenericTagTermMutationResolver;
        }
        return $this->payloadableCreateGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreateGenericTagTermMutationResolver();
    }
}
