<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\UnionType\RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver $rootUpdateGenericCategoryTermMutationErrorPayloadUnionTypeResolver = null;
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
