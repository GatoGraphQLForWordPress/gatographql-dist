<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateGenericCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostMutationResolver $updateGenericCustomPostMutationResolver = null;
    protected final function getUpdateGenericCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostMutationResolver
    {
        if ($this->updateGenericCustomPostMutationResolver === null) {
            /** @var UpdateGenericCustomPostMutationResolver */
            $updateGenericCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMutations\MutationResolvers\UpdateGenericCustomPostMutationResolver::class);
            $this->updateGenericCustomPostMutationResolver = $updateGenericCustomPostMutationResolver;
        }
        return $this->updateGenericCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateGenericCustomPostMutationResolver();
    }
}
