<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ObjectTypeResolverPickers;

use PoPCMSSchema\MediaMutations\ObjectModels\MediaItemDoesNotExistErrorPayload;
use PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\MediaItemDoesNotExistErrorPayloadObjectTypeResolver;
use PoPSchema\SchemaCommons\ObjectTypeResolverPickers\AbstractErrorPayloadObjectTypeResolverPicker;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
/** @internal */
abstract class AbstractMediaItemDoesNotExistErrorPayloadObjectTypeResolverPicker extends AbstractErrorPayloadObjectTypeResolverPicker
{
    /**
     * @var \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\MediaItemDoesNotExistErrorPayloadObjectTypeResolver|null
     */
    private $mediaItemDoesNotExistErrorPayloadObjectTypeResolver;
    public final function setMediaItemDoesNotExistErrorPayloadObjectTypeResolver(MediaItemDoesNotExistErrorPayloadObjectTypeResolver $mediaItemDoesNotExistErrorPayloadObjectTypeResolver) : void
    {
        $this->mediaItemDoesNotExistErrorPayloadObjectTypeResolver = $mediaItemDoesNotExistErrorPayloadObjectTypeResolver;
    }
    protected final function getMediaItemDoesNotExistErrorPayloadObjectTypeResolver() : MediaItemDoesNotExistErrorPayloadObjectTypeResolver
    {
        if ($this->mediaItemDoesNotExistErrorPayloadObjectTypeResolver === null) {
            /** @var MediaItemDoesNotExistErrorPayloadObjectTypeResolver */
            $mediaItemDoesNotExistErrorPayloadObjectTypeResolver = $this->instanceManager->getInstance(MediaItemDoesNotExistErrorPayloadObjectTypeResolver::class);
            $this->mediaItemDoesNotExistErrorPayloadObjectTypeResolver = $mediaItemDoesNotExistErrorPayloadObjectTypeResolver;
        }
        return $this->mediaItemDoesNotExistErrorPayloadObjectTypeResolver;
    }
    public function getObjectTypeResolver() : ObjectTypeResolverInterface
    {
        return $this->getMediaItemDoesNotExistErrorPayloadObjectTypeResolver();
    }
    protected function getTargetObjectClass() : string
    {
        return MediaItemDoesNotExistErrorPayload::class;
    }
}
