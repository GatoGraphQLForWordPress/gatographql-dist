<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserStateMutations\TypeResolvers\UnionType\RootLogoutUserMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class RootLogoutUserMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\UserStateMutations\TypeResolvers\UnionType\RootLogoutUserMutationErrorPayloadUnionTypeResolver|null
     */
    private $rootLogoutUserMutationErrorPayloadUnionTypeResolver;
    protected final function getRootLogoutUserMutationErrorPayloadUnionTypeResolver() : RootLogoutUserMutationErrorPayloadUnionTypeResolver
    {
        if ($this->rootLogoutUserMutationErrorPayloadUnionTypeResolver === null) {
            /** @var RootLogoutUserMutationErrorPayloadUnionTypeResolver */
            $rootLogoutUserMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(RootLogoutUserMutationErrorPayloadUnionTypeResolver::class);
            $this->rootLogoutUserMutationErrorPayloadUnionTypeResolver = $rootLogoutUserMutationErrorPayloadUnionTypeResolver;
        }
        return $this->rootLogoutUserMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getRootLogoutUserMutationErrorPayloadUnionTypeResolver();
    }
}
