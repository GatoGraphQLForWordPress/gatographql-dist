<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class CreateGenericCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateGenericCustomPostMutationResolver|null
     */
    private $createGenericCustomPostMutationResolver;
    public final function setCreateGenericCustomPostMutationResolver(\PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateGenericCustomPostMutationResolver $createGenericCustomPostMutationResolver) : void
    {
        $this->createGenericCustomPostMutationResolver = $createGenericCustomPostMutationResolver;
    }
    protected final function getCreateGenericCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateGenericCustomPostMutationResolver
    {
        if ($this->createGenericCustomPostMutationResolver === null) {
            /** @var CreateGenericCustomPostMutationResolver */
            $createGenericCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMutations\MutationResolvers\CreateGenericCustomPostMutationResolver::class);
            $this->createGenericCustomPostMutationResolver = $createGenericCustomPostMutationResolver;
        }
        return $this->createGenericCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getCreateGenericCustomPostMutationResolver();
    }
}
