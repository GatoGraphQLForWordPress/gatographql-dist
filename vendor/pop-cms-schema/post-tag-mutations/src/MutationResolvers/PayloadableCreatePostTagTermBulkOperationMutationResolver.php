<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableCreatePostTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableCreatePostTagTermMutationResolver|null
     */
    private $payloadableCreatePostTagTermMutationResolver;
    protected final function getPayloadableCreatePostTagTermMutationResolver() : \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableCreatePostTagTermMutationResolver
    {
        if ($this->payloadableCreatePostTagTermMutationResolver === null) {
            /** @var PayloadableCreatePostTagTermMutationResolver */
            $payloadableCreatePostTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableCreatePostTagTermMutationResolver::class);
            $this->payloadableCreatePostTagTermMutationResolver = $payloadableCreatePostTagTermMutationResolver;
        }
        return $this->payloadableCreatePostTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableCreatePostTagTermMutationResolver();
    }
}
