<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType\GenericTagAddMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class GenericTagAddMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\UnionType\GenericTagAddMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $genericTagAddMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getGenericTagAddMetaMutationErrorPayloadUnionTypeResolver() : GenericTagAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->genericTagAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var GenericTagAddMetaMutationErrorPayloadUnionTypeResolver */
            $genericTagAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(GenericTagAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->genericTagAddMetaMutationErrorPayloadUnionTypeResolver = $genericTagAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->genericTagAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getGenericTagAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
