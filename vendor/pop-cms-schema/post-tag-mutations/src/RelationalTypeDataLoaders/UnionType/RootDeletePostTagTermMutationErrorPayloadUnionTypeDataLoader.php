<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostTagMutations\TypeResolvers\UnionType\RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeletePostTagTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver $rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootDeletePostTagTermMutationErrorPayloadUnionTypeResolver() : RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver */
            $rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeletePostTagTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver = $rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeletePostTagTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeletePostTagTermMutationErrorPayloadUnionTypeResolver();
    }
}
