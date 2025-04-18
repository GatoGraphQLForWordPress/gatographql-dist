<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\AbstractUserSetMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType\UserSetMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class UserSetMetaMutationErrorPayloadUnionTypeResolver extends AbstractUserSetMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType\UserSetMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $userSetMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getUserSetMetaMutationErrorPayloadUnionTypeDataLoader() : UserSetMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->userSetMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var UserSetMetaMutationErrorPayloadUnionTypeDataLoader */
            $userSetMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(UserSetMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->userSetMetaMutationErrorPayloadUnionTypeDataLoader = $userSetMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->userSetMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'UserSetMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when setting meta on a user (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getUserSetMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
