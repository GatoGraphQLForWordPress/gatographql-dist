<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\UnionType;

use PoPCMSSchema\UserMutations\RelationalTypeDataLoaders\UnionType\UserDeleteMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class UserDeleteMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\UnionType\AbstractDeleteUserMutationErrorPayloadUnionTypeResolver
{
    private ?UserDeleteMutationErrorPayloadUnionTypeDataLoader $userDeleteMutationErrorPayloadUnionTypeDataLoader = null;
    protected final function getUserDeleteMutationErrorPayloadUnionTypeDataLoader() : UserDeleteMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->userDeleteMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var UserDeleteMutationErrorPayloadUnionTypeDataLoader */
            $userDeleteMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(UserDeleteMutationErrorPayloadUnionTypeDataLoader::class);
            $this->userDeleteMutationErrorPayloadUnionTypeDataLoader = $userDeleteMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->userDeleteMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'UserDeleteMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting a user (nested mutations)', 'gatographql');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getUserDeleteMutationErrorPayloadUnionTypeDataLoader();
    }
}
