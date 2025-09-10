<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdateMediaItemMutationPayloadObjectTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\AbstractMediaItemMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdateMediaItemMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of updating the metadata for an attachment', 'media-mutations');
    }
}
