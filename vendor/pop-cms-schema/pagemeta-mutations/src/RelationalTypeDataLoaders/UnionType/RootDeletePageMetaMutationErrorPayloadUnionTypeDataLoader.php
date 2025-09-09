<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\RootDeletePageMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeletePageMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootDeletePageMetaMutationErrorPayloadUnionTypeResolver $rootDeletePageMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootDeletePageMetaMutationErrorPayloadUnionTypeResolver() : RootDeletePageMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeletePageMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeletePageMetaMutationErrorPayloadUnionTypeResolver */
            $rootDeletePageMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeletePageMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeletePageMetaMutationErrorPayloadUnionTypeResolver = $rootDeletePageMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeletePageMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeletePageMetaMutationErrorPayloadUnionTypeResolver();
    }
}
