<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\UserAddMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserAddMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\UserAddMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $userAddMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getUserAddMetaMutationErrorPayloadUnionTypeResolver() : UserAddMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->userAddMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var UserAddMetaMutationErrorPayloadUnionTypeResolver */
            $userAddMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(UserAddMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->userAddMetaMutationErrorPayloadUnionTypeResolver = $userAddMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->userAddMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getUserAddMetaMutationErrorPayloadUnionTypeResolver();
    }
}
