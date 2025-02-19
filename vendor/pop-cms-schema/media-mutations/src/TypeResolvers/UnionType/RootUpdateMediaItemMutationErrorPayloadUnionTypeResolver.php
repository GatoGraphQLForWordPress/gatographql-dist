<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\UnionType\RootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootUpdateMediaItemMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\AbstractUpdateMediaItemMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\UnionType\RootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader() : RootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader */
            $rootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader = $rootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootUpdateMediaItemMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when updating the metadata for an attachment', 'media-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootUpdateMediaItemMutationErrorPayloadUnionTypeDataLoader();
    }
}
