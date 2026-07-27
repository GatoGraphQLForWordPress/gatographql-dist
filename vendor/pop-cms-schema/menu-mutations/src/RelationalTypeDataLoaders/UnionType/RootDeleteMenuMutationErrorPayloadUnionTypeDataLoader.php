<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\MenuMutations\TypeResolvers\UnionType\RootDeleteMenuMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeleteMenuMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootDeleteMenuMutationErrorPayloadUnionTypeResolver $rootDeleteMenuMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootDeleteMenuMutationErrorPayloadUnionTypeResolver() : RootDeleteMenuMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeleteMenuMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeleteMenuMutationErrorPayloadUnionTypeResolver */
            $rootDeleteMenuMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeleteMenuMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeleteMenuMutationErrorPayloadUnionTypeResolver = $rootDeleteMenuMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeleteMenuMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeleteMenuMutationErrorPayloadUnionTypeResolver();
    }
}
