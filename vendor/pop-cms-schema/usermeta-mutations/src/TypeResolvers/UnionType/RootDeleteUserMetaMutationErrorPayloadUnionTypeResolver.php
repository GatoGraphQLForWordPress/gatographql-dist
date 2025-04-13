<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\AbstractRootDeleteUserMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType\RootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootDeleteUserMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootDeleteUserMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType\RootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader() : RootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader = $rootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootDeleteUserMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when deleting meta on a user', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootDeleteUserMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
