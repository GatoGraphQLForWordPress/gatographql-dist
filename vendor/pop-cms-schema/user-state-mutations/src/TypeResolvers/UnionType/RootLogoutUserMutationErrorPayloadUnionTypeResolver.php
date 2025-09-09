<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserStateMutations\TypeResolvers\UnionType;

use PoPCMSSchema\UserStateMutations\RelationalTypeDataLoaders\UnionType\RootLogoutUserMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootLogoutUserMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\UserStateMutations\TypeResolvers\UnionType\AbstractUserStateMutationErrorPayloadUnionTypeResolver
{
    private ?RootLogoutUserMutationErrorPayloadUnionTypeDataLoader $rootLogoutUserMutationErrorPayloadUnionTypeDataLoader = null;
    protected final function getRootLogoutUserMutationErrorPayloadUnionTypeDataLoader() : RootLogoutUserMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootLogoutUserMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootLogoutUserMutationErrorPayloadUnionTypeDataLoader */
            $rootLogoutUserMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootLogoutUserMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootLogoutUserMutationErrorPayloadUnionTypeDataLoader = $rootLogoutUserMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootLogoutUserMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootLogoutUserMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when logging a user out', 'user-state-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootLogoutUserMutationErrorPayloadUnionTypeDataLoader();
    }
}
