<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreateGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\MutationResolvers\CreateGenericTagTermMutationResolver|null
     */
    private $createGenericTagTermMutationResolver;
    public final function setCreateGenericTagTermMutationResolver(\PoPCMSSchema\TagMutations\MutationResolvers\CreateGenericTagTermMutationResolver $createGenericTagTermMutationResolver) : void
    {
        $this->createGenericTagTermMutationResolver = $createGenericTagTermMutationResolver;
    }
    protected final function getCreateGenericTagTermMutationResolver() : \PoPCMSSchema\TagMutations\MutationResolvers\CreateGenericTagTermMutationResolver
    {
        if ($this->createGenericTagTermMutationResolver === null) {
            /** @var CreateGenericTagTermMutationResolver */
            $createGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMutations\MutationResolvers\CreateGenericTagTermMutationResolver::class);
            $this->createGenericTagTermMutationResolver = $createGenericTagTermMutationResolver;
        }
        return $this->createGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreateGenericTagTermMutationResolver();
    }
}
