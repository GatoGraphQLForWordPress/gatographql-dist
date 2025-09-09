<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\UnionType\GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver $genericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getGenericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver() : GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver */
            $genericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver = $genericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericCategoryUpdateMetaMutationErrorPayloadUnionTypeResolver();
    }
}
