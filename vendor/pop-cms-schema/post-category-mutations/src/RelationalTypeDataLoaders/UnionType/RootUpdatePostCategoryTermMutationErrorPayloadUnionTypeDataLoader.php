<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PostCategoryMutations\TypeResolvers\UnionType\RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver() : RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver */
            $rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver = $rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdatePostCategoryTermMutationErrorPayloadUnionTypeResolver();
    }
}
