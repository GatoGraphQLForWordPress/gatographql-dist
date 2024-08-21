<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdatePostTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermMutationResolver|null
     */
    private $updatePostTagTermMutationResolver;
    public final function setUpdatePostTagTermMutationResolver(\PoPCMSSchema\PostTagMutations\MutationResolvers\UpdatePostTagTermMutationResolver $updatePostTagTermMutationResolver) : void
    {
        $this->updatePostTagTermMutationResolver = $updatePostTagTermMutationResolver;
    }
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
