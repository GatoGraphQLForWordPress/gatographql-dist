<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootDeleteUserMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\RootDeleteUserMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootDeleteUserMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getRootDeleteUserMetaMutationErrorPayloadUnionTypeResolver() : RootDeleteUserMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootDeleteUserMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootDeleteUserMetaMutationErrorPayloadUnionTypeResolver */
            $rootDeleteUserMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootDeleteUserMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->rootDeleteUserMetaMutationErrorPayloadUnionTypeResolver = $rootDeleteUserMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootDeleteUserMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootDeleteUserMetaMutationErrorPayloadUnionTypeResolver();
    }
}
