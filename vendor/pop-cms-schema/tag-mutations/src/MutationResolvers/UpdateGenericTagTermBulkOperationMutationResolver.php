<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver|null
     */
    private $updateGenericTagTermMutationResolver;
    public final function setUpdateGenericTagTermMutationResolver(\PoPCMSSchema\TagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver $updateGenericTagTermMutationResolver) : void
    {
        $this->updateGenericTagTermMutationResolver = $updateGenericTagTermMutationResolver;
    }
    protected final function getUpdateGenericTagTermMutationResolver() : \PoPCMSSchema\TagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver
    {
        if ($this->updateGenericTagTermMutationResolver === null) {
            /** @var UpdateGenericTagTermMutationResolver */
            $updateGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver::class);
            $this->updateGenericTagTermMutationResolver = $updateGenericTagTermMutationResolver;
        }
        return $this->updateGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateGenericTagTermMutationResolver();
    }
}
