<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreatePageBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PageMutations\MutationResolvers\PayloadableCreatePageMutationResolver|null
     */
    private $payloadableCreatePageMutationResolver;
    public final function setPayloadableCreatePageMutationResolver(\PoPCMSSchema\PageMutations\MutationResolvers\PayloadableCreatePageMutationResolver $payloadableCreatePageMutationResolver) : void
    {
        $this->payloadableCreatePageMutationResolver = $payloadableCreatePageMutationResolver;
    }
    protected final function getPayloadableCreatePageMutationResolver() : \PoPCMSSchema\PageMutations\MutationResolvers\PayloadableCreatePageMutationResolver
    {
        if ($this->payloadableCreatePageMutationResolver === null) {
            /** @var PayloadableCreatePageMutationResolver */
            $payloadableCreatePageMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PageMutations\MutationResolvers\PayloadableCreatePageMutationResolver::class);
            $this->payloadableCreatePageMutationResolver = $payloadableCreatePageMutationResolver;
        }
        return $this->payloadableCreatePageMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreatePageMutationResolver();
    }
}
