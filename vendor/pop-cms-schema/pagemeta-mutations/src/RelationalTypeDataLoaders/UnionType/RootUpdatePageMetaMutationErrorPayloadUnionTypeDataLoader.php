<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\RootUpdatePageMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootUpdatePageMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\RootUpdatePageMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootUpdatePageMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootUpdatePageMetaMutationErrorPayloadUnionTypeResolver() : RootUpdatePageMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootUpdatePageMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootUpdatePageMetaMutationErrorPayloadUnionTypeResolver */
            $rootUpdatePageMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootUpdatePageMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootUpdatePageMetaMutationErrorPayloadUnionTypeResolver = $rootUpdatePageMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootUpdatePageMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootUpdatePageMetaMutationErrorPayloadUnionTypeResolver();
    }
}
