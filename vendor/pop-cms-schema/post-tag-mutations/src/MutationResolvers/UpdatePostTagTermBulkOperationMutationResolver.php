<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdatePostTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermMutationResolver $updatePostTagTermMutationResolver = null;
    protected final function getUpdatePostTagTermMutationResolver() : \PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermMutationResolver
    {
        if ($this->updatePostTagTermMutationResolver === null) {
            /** @var UpdatePostTagTermMutationResolver */
            $updatePostTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermMutationResolver::class);
            $this->updatePostTagTermMutationResolver = $updatePostTagTermMutationResolver;
        }
        return $this->updatePostTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdatePostTagTermMutationResolver();
    }
}
