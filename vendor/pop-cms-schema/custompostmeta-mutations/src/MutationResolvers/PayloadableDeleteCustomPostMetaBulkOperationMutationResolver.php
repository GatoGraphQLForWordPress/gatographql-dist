<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteCustomPostMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableDeleteCustomPostMetaMutationResolver $payloadableDeleteCustomPostMetaMutationResolver = null;
    protected final function getPayloadableDeleteCustomPostMetaMutationResolver() : \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableDeleteCustomPostMetaMutationResolver
    {
        if ($this->payloadableDeleteCustomPostMetaMutationResolver === null) {
            /** @var PayloadableDeleteCustomPostMetaMutationResolver */
            $payloadableDeleteCustomPostMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableDeleteCustomPostMetaMutationResolver::class);
            $this->payloadableDeleteCustomPostMetaMutationResolver = $payloadableDeleteCustomPostMetaMutationResolver;
        }
        return $this->payloadableDeleteCustomPostMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteCustomPostMetaMutationResolver();
    }
}
