<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\AbstractUserAddMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType\UserAddMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class UserAddMetaMutationErrorPayloadUnionTypeResolver extends AbstractUserAddMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType\UserAddMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $userAddMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getUserAddMetaMutationErrorPayloadUnionTypeDataLoader() : UserAddMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->userAddMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var UserAddMetaMutationErrorPayloadUnionTypeDataLoader */
            $userAddMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(UserAddMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->userAddMetaMutationErrorPayloadUnionTypeDataLoader = $userAddMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->userAddMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'UserAddMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when adding meta on a user (using nested mutations)', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getUserAddMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
