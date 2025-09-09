<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMutations\TypeResolvers\UnionType\RootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetTagsOnCustomPostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver $rootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver() : RootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver */
            $rootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver = $rootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetTagsOnCustomPostMutationErrorPayloadUnionTypeResolver();
    }
}
