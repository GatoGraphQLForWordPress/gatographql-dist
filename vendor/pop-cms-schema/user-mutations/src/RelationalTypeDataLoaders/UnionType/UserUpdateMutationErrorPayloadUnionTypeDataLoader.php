<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMutations\TypeResolvers\UnionType\UserUpdateMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserUpdateMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?UserUpdateMutationErrorPayloadUnionTypeResolver $userUpdateMutationErrorPayloadUnionTypeResolver = null;
    protected final function getUserUpdateMutationErrorPayloadUnionTypeResolver() : UserUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->userUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var UserUpdateMutationErrorPayloadUnionTypeResolver */
            $userUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(UserUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->userUpdateMutationErrorPayloadUnionTypeResolver = $userUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->userUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getUserUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
