<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\UnionType\RootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootCreateMediaItemMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\AbstractCreateMediaItemMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\UnionType\RootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader() : RootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader */
            $rootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader = $rootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootCreateMediaItemMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when uploading an attachment', 'media-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootCreateMediaItemMutationErrorPayloadUnionTypeDataLoader();
    }
}
