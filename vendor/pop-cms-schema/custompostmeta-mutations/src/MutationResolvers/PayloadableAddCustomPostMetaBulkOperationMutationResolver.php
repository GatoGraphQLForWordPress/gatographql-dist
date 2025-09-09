<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableAddCustomPostMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableAddCustomPostMetaMutationResolver $payloadableAddCustomPostMetaMutationResolver = null;
    protected final function getPayloadableAddCustomPostMetaMutationResolver() : \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableAddCustomPostMetaMutationResolver
    {
        if ($this->payloadableAddCustomPostMetaMutationResolver === null) {
            /** @var PayloadableAddCustomPostMetaMutationResolver */
            $payloadableAddCustomPostMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableAddCustomPostMetaMutationResolver::class);
            $this->payloadableAddCustomPostMetaMutationResolver = $payloadableAddCustomPostMetaMutationResolver;
        }
        return $this->payloadableAddCustomPostMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableAddCustomPostMetaMutationResolver();
    }
}
