<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootCreateMediaItemMutationPayloadObjectTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\AbstractMediaItemMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootCreateMediaItemMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of uploading an attachment', 'media-mutations');
    }
}
