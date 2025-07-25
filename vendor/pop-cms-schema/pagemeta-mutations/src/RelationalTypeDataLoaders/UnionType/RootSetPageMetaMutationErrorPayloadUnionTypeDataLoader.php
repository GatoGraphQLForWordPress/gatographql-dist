<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\RootSetPageMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetPageMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\PageMetaMutations\TypeResolvers\UnionType\RootSetPageMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetPageMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootSetPageMetaMutationErrorPayloadUnionTypeResolver() : RootSetPageMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetPageMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetPageMetaMutationErrorPayloadUnionTypeResolver */
            $rootSetPageMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetPageMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetPageMetaMutationErrorPayloadUnionTypeResolver = $rootSetPageMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetPageMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetPageMetaMutationErrorPayloadUnionTypeResolver();
    }
}
