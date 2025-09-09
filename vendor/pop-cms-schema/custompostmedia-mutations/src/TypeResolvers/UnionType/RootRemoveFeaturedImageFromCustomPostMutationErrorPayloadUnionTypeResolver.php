<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMediaMutations\RelationalTypeDataLoaders\UnionType\RootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\AbstractCustomPostMediaMutationErrorPayloadUnionTypeResolver
{
    private ?RootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader $rootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader = null;
    protected final function getRootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader() : RootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader */
            $rootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader = $rootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when removing a featured image from a custom post', 'custompostmedia-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootRemoveFeaturedImageFromCustomPostMutationErrorPayloadUnionTypeDataLoader();
    }
}
