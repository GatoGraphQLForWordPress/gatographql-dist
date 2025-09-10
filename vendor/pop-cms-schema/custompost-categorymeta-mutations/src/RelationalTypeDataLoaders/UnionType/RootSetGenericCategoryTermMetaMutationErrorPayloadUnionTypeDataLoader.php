<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\UnionType\RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver $rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver() : RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver */
            $rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver = $rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetGenericCategoryTermMetaMutationErrorPayloadUnionTypeResolver();
    }
}
