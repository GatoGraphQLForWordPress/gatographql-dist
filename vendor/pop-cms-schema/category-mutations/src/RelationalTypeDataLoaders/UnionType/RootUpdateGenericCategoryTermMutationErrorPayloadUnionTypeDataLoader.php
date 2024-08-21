<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CategoryMutations\TypeResolvers\UnionType\RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    public final function setRootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver(RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver) : void
    {
        $this->rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected final function getRootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver() : RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver */
            $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver();
    }
}
