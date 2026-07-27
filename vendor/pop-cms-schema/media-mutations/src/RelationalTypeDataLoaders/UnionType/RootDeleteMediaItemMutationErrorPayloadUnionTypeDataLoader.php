<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\RootDeleteMediaItemMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeleteMediaItemMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootDeleteMediaItemMutationErrorPayloadUnionTypeResolver $rootDeleteMediaItemMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootDeleteMediaItemMutationErrorPayloadUnionTypeResolver() : RootDeleteMediaItemMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeleteMediaItemMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeleteMediaItemMutationErrorPayloadUnionTypeResolver */
            $rootDeleteMediaItemMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeleteMediaItemMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeleteMediaItemMutationErrorPayloadUnionTypeResolver = $rootDeleteMediaItemMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeleteMediaItemMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeleteMediaItemMutationErrorPayloadUnionTypeResolver();
    }
}
