<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMutations\TypeResolvers\UnionType\RootDeletePostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeletePostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootDeletePostMutationErrorPayloadUnionTypeResolver $rootDeletePostMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootDeletePostMutationErrorPayloadUnionTypeResolver() : RootDeletePostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeletePostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeletePostMutationErrorPayloadUnionTypeResolver */
            $rootDeletePostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeletePostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeletePostMutationErrorPayloadUnionTypeResolver = $rootDeletePostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeletePostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeletePostMutationErrorPayloadUnionTypeResolver();
    }
}
