<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\MutationResolvers;

use PoPCMSSchema\SchemaCommons\MutationResolvers\AbstractBulkOperationDecoratorMutationResolver;
use PoP\ComponentModel\MutationResolvers\MutationResolverInterface;
/** @internal */
class SetFeaturedImageOnCustomPostBulkOperationMutationResolver extends AbstractBulkOperationDecoratorMutationResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver|null
     */
    private $setFeaturedImageOnCustomPostMutationResolver;
    public final function setSetFeaturedImageOnCustomPostMutationResolver(\PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver $setFeaturedImageOnCustomPostMutationResolver) : void
    {
        $this->setFeaturedImageOnCustomPostMutationResolver = $setFeaturedImageOnCustomPostMutationResolver;
    }
    protected final function getSetFeaturedImageOnCustomPostMutationResolver() : \PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver
    {
        if ($this->setFeaturedImageOnCustomPostMutationResolver === null) {
            /** @var SetFeaturedImageOnCustomPostMutationResolver */
            $setFeaturedImageOnCustomPostMutationResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostMediaMutations\MutationResolvers\SetFeaturedImageOnCustomPostMutationResolver::class);
            $this->setFeaturedImageOnCustomPostMutationResolver = $setFeaturedImageOnCustomPostMutationResolver;
        }
        return $this->setFeaturedImageOnCustomPostMutationResolver;
    }
    protected function getDecoratedOperationMutationResolver() : MutationResolverInterface
    {
        return $this->getSetFeaturedImageOnCustomPostMutationResolver();
    }
}
