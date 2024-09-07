<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreateGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\CreateGenericTagTermMutationResolver|null
     */
    private $createGenericTagTermMutationResolver;
    public final function setCreateGenericTagTermMutationResolver(\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\CreateGenericTagTermMutationResolver $createGenericTagTermMutationResolver) : void
    {
        $this->createGenericTagTermMutationResolver = $createGenericTagTermMutationResolver;
    }
    protected final function getCreateGenericTagTermMutationResolver() : \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\CreateGenericTagTermMutationResolver
    {
        if ($this->createGenericTagTermMutationResolver === null) {
            /** @var CreateGenericTagTermMutationResolver */
            $createGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\CreateGenericTagTermMutationResolver::class);
            $this->createGenericTagTermMutationResolver = $createGenericTagTermMutationResolver;
        }
        return $this->createGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreateGenericTagTermMutationResolver();
    }
}
