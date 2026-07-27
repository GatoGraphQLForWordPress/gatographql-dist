<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableDeleteMenuBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableDeleteMenuMutationResolver $payloadableDeleteMenuMutationResolver = null;
    protected final function getPayloadableDeleteMenuMutationResolver() : \PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableDeleteMenuMutationResolver
    {
        if ($this->payloadableDeleteMenuMutationResolver === null) {
            /** @var PayloadableDeleteMenuMutationResolver */
            $payloadableDeleteMenuMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableDeleteMenuMutationResolver::class);
            $this->payloadableDeleteMenuMutationResolver = $payloadableDeleteMenuMutationResolver;
        }
        return $this->payloadableDeleteMenuMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableDeleteMenuMutationResolver();
    }
}
