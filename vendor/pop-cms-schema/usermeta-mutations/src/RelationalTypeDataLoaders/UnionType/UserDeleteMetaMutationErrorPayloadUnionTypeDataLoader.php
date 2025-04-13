<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\UserDeleteMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserDeleteMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\UserDeleteMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $userDeleteMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getUserDeleteMetaMutationErrorPayloadUnionTypeResolver() : UserDeleteMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->userDeleteMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var UserDeleteMetaMutationErrorPayloadUnionTypeResolver */
            $userDeleteMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(UserDeleteMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->userDeleteMetaMutationErrorPayloadUnionTypeResolver = $userDeleteMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->userDeleteMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getUserDeleteMetaMutationErrorPayloadUnionTypeResolver();
    }
}
