<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\UserMetaMutations\TypeResolvers\UnionType\AbstractRootSetUserMetaMutationErrorPayloadUnionTypeResolver;
use PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType\RootSetUserMetaMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootSetUserMetaMutationErrorPayloadUnionTypeResolver extends AbstractRootSetUserMetaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\UserMetaMutations\RelationalTypeDataLoaders\UnionType\RootSetUserMetaMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootSetUserMetaMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootSetUserMetaMutationErrorPayloadUnionTypeDataLoader() : RootSetUserMetaMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootSetUserMetaMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootSetUserMetaMutationErrorPayloadUnionTypeDataLoader */
            $rootSetUserMetaMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootSetUserMetaMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootSetUserMetaMutationErrorPayloadUnionTypeDataLoader = $rootSetUserMetaMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootSetUserMetaMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootSetUserMetaMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when setting meta on a user', 'post-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootSetUserMetaMutationErrorPayloadUnionTypeDataLoader();
    }
}
