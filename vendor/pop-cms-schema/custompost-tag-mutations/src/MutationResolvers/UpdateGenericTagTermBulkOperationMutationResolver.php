<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class UpdateGenericTagTermBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver $updateGenericTagTermMutationResolver = null;
    protected final function getUpdateGenericTagTermMutationResolver() : \PoPCMSSchema\CustomPostTagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver
    {
        if ($this->updateGenericTagTermMutationResolver === null) {
            /** @var UpdateGenericTagTermMutationResolver */
            $updateGenericTagTermMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostTagMutations\MutationResolvers\UpdateGenericTagTermMutationResolver::class);
            $this->updateGenericTagTermMutationResolver = $updateGenericTagTermMutationResolver;
        }
        return $this->updateGenericTagTermMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getUpdateGenericTagTermMutationResolver();
    }
}
