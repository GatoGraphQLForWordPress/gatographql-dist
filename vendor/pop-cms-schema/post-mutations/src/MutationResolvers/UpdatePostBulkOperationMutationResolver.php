<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdatePostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\PostMutations\MutationResolvers\UpdatePostMutationResolver|null
     */
    private $updatePostMutationResolver;
    public final function setUpdatePostMutationResolver(\PoPCMSSchema\PostMutations\MutationResolvers\UpdatePostMutationResolver $updatePostMutationResolver) : void
    {
        $this->updatePostMutationResolver = $updatePostMutationResolver;
    }
    protected final function getUpdatePostMutationResolver() : \PoPCMSSchema\PostMutations\MutationResolvers\UpdatePostMutationResolver
    {
        if ($this->updatePostMutationResolver === null) {
            /** @var UpdatePostMutationResolver */
            $updatePostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\PostMutations\MutationResolvers\UpdatePostMutationResolver::class);
            $this->updatePostMutationResolver = $updatePostMutationResolver;
        }
        return $this->updatePostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdatePostMutationResolver();
    }
}
