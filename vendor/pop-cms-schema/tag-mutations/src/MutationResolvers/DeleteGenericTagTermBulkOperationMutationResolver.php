<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\MutationResolvers\DeleteGenericTagTermMutationResolver|null
     */
    private $deleteGenericTagTermMutationResolver;
    public final function setDeleteGenericTagTermMutationResolver(\PoPCMSSchema\TagMutations\MutationResolvers\DeleteGenericTagTermMutationResolver $deleteGenericTagTermMutationResolver) : void
    {
        $this->deleteGenericTagTermMutationResolver = $deleteGenericTagTermMutationResolver;
    }
    protected final function getDeleteGenericTagTermMutationResolver() : \PoPCMSSchema\TagMutations\MutationResolvers\DeleteGenericTagTermMutationResolver
    {
        if ($this->deleteGenericTagTermMutationResolver === null) {
            /** @var DeleteGenericTagTermMutationResolver */
            $deleteGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMutations\MutationResolvers\DeleteGenericTagTermMutationResolver::class);
            $this->deleteGenericTagTermMutationResolver = $deleteGenericTagTermMutationResolver;
        }
        return $this->deleteGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteGenericTagTermMutationResolver();
    }
}
