<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\UserSetMetaMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class UserSetMetaMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\UserSetMetaMutationErrorPayloadUnionTypeResolver|null
     */
    private $userSetMetaMutationErrorPayloadUnionTypeResolver;
    protected final function getUserSetMetaMutationErrorPayloadUnionTypeResolver() : UserSetMetaMutationErrorPayloadUnionTypeResolver
    {
        if ($this->userSetMetaMutationErrorPayloadUnionTypeResolver === null) {
            /** @var UserSetMetaMutationErrorPayloadUnionTypeResolver */
            $userSetMetaMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(UserSetMetaMutationErrorPayloadUnionTypeResolver::class);
            $this->userSetMetaMutationErrorPayloadUnionTypeResolver = $userSetMetaMutationErrorPayloadUnionTypeResolver;
        }
        return $this->userSetMetaMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getUserSetMetaMutationErrorPayloadUnionTypeResolver();
    }
}
