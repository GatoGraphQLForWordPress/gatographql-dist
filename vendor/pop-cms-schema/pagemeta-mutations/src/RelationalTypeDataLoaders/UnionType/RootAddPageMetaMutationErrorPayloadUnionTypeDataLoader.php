<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\RootAddPageMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootAddPageMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\RootAddPageMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootAddPageMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootAddPageMetaMutationErrorPayloadUnionTypeResolver() : RootAddPageMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootAddPageMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootAddPageMetaMutationErrorPayloadUnionTypeResolver */
            $rootAddPageMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootAddPageMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootAddPageMetaMutationErrorPayloadUnionTypeResolver = $rootAddPageMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootAddPageMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootAddPageMetaMutationErrorPayloadUnionTypeResolver();
    }
}
