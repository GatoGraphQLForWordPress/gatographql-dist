<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver() : RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver */
            $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver = $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver();
    }
}
