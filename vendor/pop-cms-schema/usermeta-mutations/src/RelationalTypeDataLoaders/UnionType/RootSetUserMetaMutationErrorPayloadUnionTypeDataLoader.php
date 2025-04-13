<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootSetUserMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootSetUserMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootSetUserMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootSetUserMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootSetUserMetaMutationErrorPayloadUnionTypeResolver() : RootSetUserMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootSetUserMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootSetUserMetaMutationErrorPayloadUnionTypeResolver */
            $rootSetUserMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootSetUserMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootSetUserMetaMutationErrorPayloadUnionTypeResolver = $rootSetUserMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootSetUserMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootSetUserMetaMutationErrorPayloadUnionTypeResolver();
    }
}
