<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableUpdateMenuBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableUpdateMenuMutationResolver $payloadableUpdateMenuMutationResolver = null;
    protected final function getPayloadableUpdateMenuMutationResolver() : \PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableUpdateMenuMutationResolver
    {
        if ($this->payloadableUpdateMenuMutationResolver === null) {
            /** @var PayloadableUpdateMenuMutationResolver */
            $payloadableUpdateMenuMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableUpdateMenuMutationResolver::class);
            $this->payloadableUpdateMenuMutationResolver = $payloadableUpdateMenuMutationResolver;
        }
        return $this->payloadableUpdateMenuMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableUpdateMenuMutationResolver();
    }
}
