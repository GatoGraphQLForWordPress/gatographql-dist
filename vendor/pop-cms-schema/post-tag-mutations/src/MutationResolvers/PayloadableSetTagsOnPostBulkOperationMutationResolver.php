<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetTagsOnPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableSetTagsOnPostMutationResolver $payloadableSetTagsOnPostMutationResolver = null;
    protected final function getPayloadableSetTagsOnPostMutationResolver() : \PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableSetTagsOnPostMutationResolver
    {
        if ($this->payloadableSetTagsOnPostMutationResolver === null) {
            /** @var PayloadableSetTagsOnPostMutationResolver */
            $payloadableSetTagsOnPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostTagMutations\MutationResolvers\PayloadableSetTagsOnPostMutationResolver::class);
            $this->payloadableSetTagsOnPostMutationResolver = $payloadableSetTagsOnPostMutationResolver;
        }
        return $this->payloadableSetTagsOnPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetTagsOnPostMutationResolver();
    }
}
