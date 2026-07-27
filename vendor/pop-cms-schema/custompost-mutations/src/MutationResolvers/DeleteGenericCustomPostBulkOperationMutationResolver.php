<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteGenericCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostMutations\MutationResolvers\DeleteGenericCustomPostMutationResolver $deleteGenericCustomPostMutationResolver = null;
    protected final function getDeleteGenericCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMutations\MutationResolvers\DeleteGenericCustomPostMutationResolver
    {
        if ($this->deleteGenericCustomPostMutationResolver === null) {
            /** @var DeleteGenericCustomPostMutationResolver */
            $deleteGenericCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMutations\MutationResolvers\DeleteGenericCustomPostMutationResolver::class);
            $this->deleteGenericCustomPostMutationResolver = $deleteGenericCustomPostMutationResolver;
        }
        return $this->deleteGenericCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteGenericCustomPostMutationResolver();
    }
}
