<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class PayloadableSetTagsOnCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostMutationResolver|null
     */
    private $payloadableSetTagsOnCustomPostMutationResolver;
    public final function setPayloadableSetTagsOnCustomPostMutationResolver(\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostMutationResolver $payloadableSetTagsOnCustomPostMutationResolver) : void
    {
        $this->payloadableSetTagsOnCustomPostMutationResolver = $payloadableSetTagsOnCustomPostMutationResolver;
    }
    protected final function getPayloadableSetTagsOnCustomPostMutationResolver() : \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostMutationResolver
    {
        if ($this->payloadableSetTagsOnCustomPostMutationResolver === null) {
            /** @var PayloadableSetTagsOnCustomPostMutationResolver */
            $payloadableSetTagsOnCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\PayloadableSetTagsOnCustomPostMutationResolver::class);
            $this->payloadableSetTagsOnCustomPostMutationResolver = $payloadableSetTagsOnCustomPostMutationResolver;
        }
        return $this->payloadableSetTagsOnCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getPayloadableSetTagsOnCustomPostMutationResolver();
    }
}
