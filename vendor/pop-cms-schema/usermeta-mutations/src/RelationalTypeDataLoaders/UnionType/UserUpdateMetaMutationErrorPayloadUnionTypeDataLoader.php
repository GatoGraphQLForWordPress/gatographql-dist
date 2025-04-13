<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\UserUpdateMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserUpdateMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\UserUpdateMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $userUpdateMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getUserUpdateMetaMutationErrorPayloadUnionTypeResolver() : UserUpdateMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->userUpdateMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var UserUpdateMetaMutationErrorPayloadUnionTypeResolver */
            $userUpdateMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(UserUpdateMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->userUpdateMetaMutationErrorPayloadUnionTypeResolver = $userUpdateMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->userUpdateMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getUserUpdateMetaMutationErrorPayloadUnionTypeResolver();
    }
}
