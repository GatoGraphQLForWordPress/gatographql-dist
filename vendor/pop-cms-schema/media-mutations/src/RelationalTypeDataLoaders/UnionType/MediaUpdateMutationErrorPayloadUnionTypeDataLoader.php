<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\UnionType;

use PoPCMSSchema\MediaMutations\TypeResolvers\UnionType\MediaUpdateMutationErrorPayloadUnionTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\UnionType\AbstractUnionTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface;
/** @internal */
class MediaUpdateMutationErrorPayloadUnionTypeDataLoader extends AbstractUnionTypeDataLoader
{
    private ?MediaUpdateMutationErrorPayloadUnionTypeResolver $mediaUpdateMutationErrorPayloadUnionTypeResolver = null;
    protected final function getMediaUpdateMutationErrorPayloadUnionTypeResolver() : MediaUpdateMutationErrorPayloadUnionTypeResolver
    {
        if ($this->mediaUpdateMutationErrorPayloadUnionTypeResolver === null) {
            /** @var MediaUpdateMutationErrorPayloadUnionTypeResolver */
            $mediaUpdateMutationErrorPayloadUnionTypeResolver = $this->instanceManager->getInstance(MediaUpdateMutationErrorPayloadUnionTypeResolver::class);
            $this->mediaUpdateMutationErrorPayloadUnionTypeResolver = $mediaUpdateMutationErrorPayloadUnionTypeResolver;
        }
        return $this->mediaUpdateMutationErrorPayloadUnionTypeResolver;
    }
    protected function getUnionTypeResolver() : UnionTypeResolverInterface
    {
        return $this->getMediaUpdateMutationErrorPayloadUnionTypeResolver();
    }
}
