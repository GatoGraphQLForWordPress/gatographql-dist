<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostMutations\TypeResolvers\UnionType\RootCreatePostMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootCreatePostMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostMutations\TypeResolvers\UnionType\RootCreatePostMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreatePostMutationErrorPayloadUnionTypeResolver;
    public final function setRootCreatePostMutationErrorPayloadUnionTypeResolver(RootCreatePostMutationErrorPayloadUnionTypeResolver $rootCreatePostMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootCreatePostMutationErrorPayloadUnionTypeResolver = $rootCreatePostMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootCreatePostMutationErrorPayloadUnionTypeResolver() : RootCreatePostMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreatePostMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreatePostMutationErrorPayloadUnionTypeResolver */
            $rootCreatePostMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreatePostMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreatePostMutationErrorPayloadUnionTypeResolver = $rootCreatePostMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreatePostMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootCreatePostMutationErrorPayloadUnionTypeResolver();
    }
}
