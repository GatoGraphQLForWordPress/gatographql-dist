<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class AddTagTermMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\TagMetaMutations\MutationResolvers\AddTagTermMetaMutationResolver|null
     */
    private $addTagTermMetaMutationResolver;
    protected final function getAddTagTermMetaMutationResolver() : \PoPCMSSchema\TagMetaMutations\MutationResolvers\AddTagTermMetaMutationResolver
    {
        if ($this->addTagTermMetaMutationResolver === null) {
            /** @var AddTagTermMetaMutationResolver */
            $addTagTermMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\TagMetaMutations\MutationResolvers\AddTagTermMetaMutationResolver::class);
            $this->addTagTermMetaMutationResolver = $addTagTermMetaMutationResolver;
        }
        return $this->addTagTermMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getAddTagTermMetaMutationResolver();
    }
}
