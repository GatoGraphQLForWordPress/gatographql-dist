<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class SetTagsOnPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostTagMutations\MutationResolvers\SetTagsOnPostMutationResolver $setTagsOnPostMutationResolver = null;
    protected final function getSetTagsOnPostMutationResolver() : \PoPCMSSchema\PostTagMutations\MutationResolvers\SetTagsOnPostMutationResolver
    {
        if ($this->setTagsOnPostMutationResolver === null) {
            /** @var SetTagsOnPostMutationResolver */
            $setTagsOnPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostTagMutations\MutationResolvers\SetTagsOnPostMutationResolver::class);
            $this->setTagsOnPostMutationResolver = $setTagsOnPostMutationResolver;
        }
        return $this->setTagsOnPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetTagsOnPostMutationResolver();
    }
}
