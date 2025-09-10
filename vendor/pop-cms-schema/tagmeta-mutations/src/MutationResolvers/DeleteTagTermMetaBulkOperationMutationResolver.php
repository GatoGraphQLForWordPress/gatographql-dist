<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class DeleteTagTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    private ?\PoPCMSSchema\TagMetaMutations\MutationResolvers\DeleteTagTermMetaMutationResolver $deleteTagTermMetaMutationResolver = null;
    protected final function getDeleteTagTermMetaMutationResolver() : \PoPCMSSchema\TagMetaMutations\MutationResolvers\DeleteTagTermMetaMutationResolver
    {
        if ($this->deleteTagTermMetaMutationResolver === null) {
            /** @var DeleteTagTermMetaMutationResolver */
            $deleteTagTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMetaMutations\MutationResolvers\DeleteTagTermMetaMutationResolver::class);
            $this->deleteTagTermMetaMutationResolver = $deleteTagTermMetaMutationResolver;
        }
        return $this->deleteTagTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getDeleteTagTermMetaMutationResolver();
    }
}
