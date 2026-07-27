<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMutations\TypeResolvers\UnionType\UserDeleteMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserDeleteMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?UserDeleteMutationErrorPayloadUnionTypeResolver $userDeleteMutationErrorPayloadUnionTypeResolver = null;
    protected final function getUserDeleteMutationErrorPayloadUnionTypeResolver() : UserDeleteMutationErrorPayloadUnionTypeResolver
    {
        if ($this->userDeleteMutationErrorPayloadUnionTypeResolver === null) {
            /** @var UserDeleteMutationErrorPayloadUnionTypeResolver */
            $userDeleteMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(UserDeleteMutationErrorPayloadUnionTypeResolver::class);
            $this->userDeleteMutationErrorPayloadUnionTypeResolver = $userDeleteMutationErrorPayloadUnionTypeResolver;
        }
        return $this->userDeleteMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getUserDeleteMutationErrorPayloadUnionTypeResolver();
    }
}
