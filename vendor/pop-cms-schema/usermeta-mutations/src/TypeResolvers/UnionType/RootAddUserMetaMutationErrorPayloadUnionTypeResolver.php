<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\AbstractRootAddUserMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType\RootAddUserMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootAddUserMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootAddUserMetaMutationErrorPayloadUnionTypeResolver
{
    private ?RootAddUserMetaMutationErrorPayloadUnionTypeDataLoader $rootAddUserMetaMutationErrorPayloadUnionTypeDataLoader = null;
    protected final function getRootAddUserMetaMutationErrorPayloadUnionTypeDataLoader() : RootAddUserMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootAddUserMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootAddUserMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootAddUserMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootAddUserMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootAddUserMetaMutationErrorPayloadUnionTypeDataLoader = $rootAddUserMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootAddUserMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootAddUserMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when adding meta on a user', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootAddUserMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
