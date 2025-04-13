<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class SetCustomPostMetaBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\SetCustomPostMetaMutationResolver|null
     */
    private $setCustomPostMetaMutationResolver;
    protected final function getSetCustomPostMetaMutationResolver() : \PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\SetCustomPostMetaMutationResolver
    {
        if ($this->setCustomPostMetaMutationResolver === null) {
            /** @var SetCustomPostMetaMutationResolver */
            $setCustomPostMetaMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMetaMutations\MutationResolvers\SetCustomPostMetaMutationResolver::class);
            $this->setCustomPostMetaMutationResolver = $setCustomPostMetaMutationResolver;
        }
        return $this->setCustomPostMetaMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetCustomPostMetaMutationResolver();
    }
}
