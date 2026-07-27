<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType;

/** @internal */
class MediaDeleteMutationPayloadObjectTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\ObjectType\AbstractMediaItemMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'MediaDeleteMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of deleting an attachment (nested mutations)', 'gatographql');
    }
}
