<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver(RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver() : RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver */
            $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootCreateGenericCategoryTermMutationErrorPayloadUnionTypeResolver();
    }
}
