<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootAddUserMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootAddUserMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?RootAddUserMetaMutationErrorPayloadUnionTypeResolver $rootAddUserMetaMutationErrorPayloadUnionTypeResolver = null;
    protected final function getRootAddUserMetaMutationErrorPayloadUnionTypeResolver() : RootAddUserMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootAddUserMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootAddUserMetaMutationErrorPayloadUnionTypeResolver */
            $rootAddUserMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootAddUserMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootAddUserMetaMutationErrorPayloadUnionTypeResolver = $rootAddUserMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootAddUserMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootAddUserMetaMutationErrorPayloadUnionTypeResolver();
    }
}
