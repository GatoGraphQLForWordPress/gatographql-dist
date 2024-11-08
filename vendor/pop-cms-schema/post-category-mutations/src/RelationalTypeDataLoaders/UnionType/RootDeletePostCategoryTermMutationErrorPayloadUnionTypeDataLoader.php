<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeletePostCategoryTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    protected final function getRootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver() : RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver */
            $rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver = $rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeletePostCategoryTermMutationErrorPayloadUnionTypeResolver();
    }
}
