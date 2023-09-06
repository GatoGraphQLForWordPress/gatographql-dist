<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootSetTagsOnPostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
class RootSetTagsOnPostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootSetTagsOnPostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetTagsOnPostMutationErrorPayloadUnionTypeResolver;
    public final function setRootSetTagsOnPostMutationErrorPayloadUnionTypeResolver(RootSetTagsOnPostMutationErrorPayloadUnionTypeResolver $rootSetTagsOnPostMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootSetTagsOnPostMutationErrorPayloadUnionTypeResolver = $rootSetTagsOnPostMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootSetTagsOnPostMutationErrorPayloadUnionTypeResolver() : RootSetTagsOnPostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetTagsOnPostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetTagsOnPostMutationErrorPayloadUnionTypeResolver */
            $rootSetTagsOnPostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetTagsOnPostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetTagsOnPostMutationErrorPayloadUnionTypeResolver = $rootSetTagsOnPostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetTagsOnPostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetTagsOnPostMutationErrorPayloadUnionTypeResolver();
    }
}
