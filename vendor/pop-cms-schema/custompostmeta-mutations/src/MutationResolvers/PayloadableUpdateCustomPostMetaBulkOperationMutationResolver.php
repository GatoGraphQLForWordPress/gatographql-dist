<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateCustomPostMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableUpdateCustomPostMetaMutationResolver|null
     */
    private $payloadableUpdateCustomPostMetaMutationResolver;
    protected final function getPayloadableUpdateCustomPostMetaMutationResolver() : \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableUpdateCustomPostMetaMutationResolver
    {
        if ($this->payloadableUpdateCustomPostMetaMutationResolver === null) {
            /** @var PayloadableUpdateCustomPostMetaMutationResolver */
            $payloadableUpdateCustomPostMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableUpdateCustomPostMetaMutationResolver::class);
            $this->payloadableUpdateCustomPostMetaMutationResolver = $payloadableUpdateCustomPostMetaMutationResolver;
        }
        return $this->payloadableUpdateCustomPostMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateCustomPostMetaMutationResolver();
    }
}
