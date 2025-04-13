<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetCustomPostMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableSetCustomPostMetaMutationResolver|null
     */
    private $payloadableSetCustomPostMetaMutationResolver;
    protected final function getPayloadableSetCustomPostMetaMutationResolver() : \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableSetCustomPostMetaMutationResolver
    {
        if ($this->payloadableSetCustomPostMetaMutationResolver === null) {
            /** @var PayloadableSetCustomPostMetaMutationResolver */
            $payloadableSetCustomPostMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\PayloadableSetCustomPostMetaMutationResolver::class);
            $this->payloadableSetCustomPostMetaMutationResolver = $payloadableSetCustomPostMetaMutationResolver;
        }
        return $this->payloadableSetCustomPostMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetCustomPostMetaMutationResolver();
    }
}
