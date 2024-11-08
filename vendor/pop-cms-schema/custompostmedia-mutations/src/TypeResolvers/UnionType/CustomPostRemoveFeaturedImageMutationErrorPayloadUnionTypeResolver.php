<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType;

use PoPCMSSchema\CustomPostMediaMutations\RelationalTypeDataLoaders\UnionType\CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeResolver extends \PoPCMSSchema\CustomPostMediaMutations\TypeResolvers\UnionType\AbstractCustomPostMediaMutationErrorPayloadUnionTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMediaMutations\RelationalTypeDataLoaders\UnionType\CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader|null
     */
    private $customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader;
    protected final function getCustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader() : CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader
    {
        if ($this->customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader === null) {
            /** @var CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader */
            $customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader = $this->instanceManager->getInstance(CustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader::class);
            $this->customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader = $customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader;
        }
        return $this->customPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'CustomPostRemoveFeaturedImageMutationErrorPayloadUnion';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Union of \'Error Payload\' types when removing a featured from a custom post (using nested mutations)', 'custompostmedia-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getCustomPostRemoveFeaturedImageMutationErrorPayloadUnionTypeDataLoader();
    }
}
