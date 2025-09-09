<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType\GenericTagUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericTagUpdateMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?GenericTagUpdateMetaMutationErrorPayloadUnionTypeResolver $genericTagUpdateMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getGenericTagUpdateMetaMutationErrorPayloadUnionTypeResolver() : GenericTagUpdateMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericTagUpdateMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericTagUpdateMetaMutationErrorPayloadUnionTypeResolver */
            $genericTagUpdateMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericTagUpdateMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericTagUpdateMetaMutationErrorPayloadUnionTypeResolver = $genericTagUpdateMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericTagUpdateMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericTagUpdateMetaMutationErrorPayloadUnionTypeResolver();
    }
}
