<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver $payloadableUpdateGenericTagTermMutationResolver = null;
    protected final function getPayloadableUpdateGenericTagTermMutationResolver() : \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver
    {
        if ($this->payloadableUpdateGenericTagTermMutationResolver === null) {
            /** @var PayloadableUpdateGenericTagTermMutationResolver */
            $payloadableUpdateGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableUpdateGenericTagTermMutationResolver::class);
            $this->payloadableUpdateGenericTagTermMutationResolver = $payloadableUpdateGenericTagTermMutationResolver;
        }
        return $this->payloadableUpdateGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateGenericTagTermMutationResolver();
    }
}
