<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType\GenericTagDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericTagDeleteMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?GenericTagDeleteMetaMutationErrorPayloadUnionTypeResolver $genericTagDeleteMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getGenericTagDeleteMetaMutationErrorPayloadUnionTypeResolver() : GenericTagDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericTagDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericTagDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $genericTagDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericTagDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericTagDeleteMetaMutationErrorPayloadUnionTypeResolver = $genericTagDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericTagDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericTagDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
