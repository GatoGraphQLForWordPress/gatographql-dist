<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\MenuMutations\TypeResolvers\UnionType\MenuDeleteMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class MenuDeleteMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?MenuDeleteMutationErrorPayloadUnionTypeResolver $menuDeleteMutationErrorPayloadUnionTypeResolver = null;
    protected final function getMenuDeleteMutationErrorPayloadUnionTypeResolver() : MenuDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->menuDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var MenuDeleteMutationErrorPayloadUnionTypeResolver */
            $menuDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(MenuDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->menuDeleteMutationErrorPayloadUnionTypeResolver = $menuDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->menuDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getMenuDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
