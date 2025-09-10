<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\RootCreateMediaItemMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootCreateMediaItemMutationErrorPayloadUnionTypeResolver $rootCreateMediaItemMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootCreateMediaItemMutationErrorPayloadUnionTypeResolver() : RootCreateMediaItemMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootCreateMediaItemMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootCreateMediaItemMutationErrorPayloadUnionTypeResolver */
            $rootCreateMediaItemMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootCreateMediaItemMutationErrorPayloadUnionTypeResolver::class);
            $this->rootCreateMediaItemMutationErrorPayloadUnionTypeResolver = $rootCreateMediaItemMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootCreateMediaItemMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootCreateMediaItemMutationErrorPayloadUnionTypeResolver();
    }
}
