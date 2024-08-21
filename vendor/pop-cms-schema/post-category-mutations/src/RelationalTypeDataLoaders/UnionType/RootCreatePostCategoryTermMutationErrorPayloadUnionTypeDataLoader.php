<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootCreatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver(RootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver $rootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver = $rootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver() : RootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver */
            $rootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver = $rootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootCreatePostCategoryTermMutationErrorPayloadUnionTypeResolver();
    }
}
