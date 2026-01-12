<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreateMenuBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableCreateMenuMutationResolver $payloadableCreateMenuMutationResolver = null;
    protected final function getPayloadableCreateMenuMutationResolver() : \PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableCreateMenuMutationResolver
    {
        if ($this->payloadableCreateMenuMutationResolver === null) {
            /** @var PayloadableCreateMenuMutationResolver */
            $payloadableCreateMenuMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\MenuMutations\MutationResolvers\PayloadableCreateMenuMutationResolver::class);
            $this->payloadableCreateMenuMutationResolver = $payloadableCreateMenuMutationResolver;
        }
        return $this->payloadableCreateMenuMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreateMenuMutationResolver();
    }
}
