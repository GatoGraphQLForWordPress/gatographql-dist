<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMediaMutations\RelationalTypeDataLoaders\UnionType\RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\AbstractCustomPostMediaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\RelationalTypeDataLoaders\UnionType\RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader;
    protected final function getRootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader() : RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader */
            $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader::class);
            $this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader = $rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->rootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'RootSetFeaturedImageOnCustomPostMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when setting a featured image to a custom post', 'custompostmedia-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getRootSetFeaturedImageOnCustomPostMutationErrorPayloadUnionTypeDataLoader();
    }
}
