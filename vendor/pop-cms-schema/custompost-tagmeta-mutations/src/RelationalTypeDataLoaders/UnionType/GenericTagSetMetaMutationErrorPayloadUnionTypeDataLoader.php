<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType\GenericTagSetMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericTagSetMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?GenericTagSetMetaMutationErrorPayloadUnionTypeResolver $genericTagSetMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getGenericTagSetMetaMutationErrorPayloadUnionTypeResolver() : GenericTagSetMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericTagSetMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericTagSetMetaMutationErrorPayloadUnionTypeResolver */
            $genericTagSetMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericTagSetMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericTagSetMetaMutationErrorPayloadUnionTypeResolver = $genericTagSetMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericTagSetMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericTagSetMetaMutationErrorPayloadUnionTypeResolver();
    }
}
