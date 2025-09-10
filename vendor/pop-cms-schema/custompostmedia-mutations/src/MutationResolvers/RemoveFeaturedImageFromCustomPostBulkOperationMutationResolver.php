<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class RemoveFeaturedImageFromCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostMutationResolver $removeFeaturedImageFromCustomPostMutationResolver = null;
    protected final function getRemoveFeaturedImageFromCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostMutationResolver
    {
        if ($this->removeFeaturedImageFromCustomPostMutationResolver === null) {
            /** @var RemoveFeaturedImageFromCustomPostMutationResolver */
            $removeFeaturedImageFromCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\RemoveFeaturedImageFromCustomPostMutationResolver::class);
            $this->removeFeaturedImageFromCustomPostMutationResolver = $removeFeaturedImageFromCustomPostMutationResolver;
        }
        return $this->removeFeaturedImageFromCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getRemoveFeaturedImageFromCustomPostMutationResolver();
    }
}
