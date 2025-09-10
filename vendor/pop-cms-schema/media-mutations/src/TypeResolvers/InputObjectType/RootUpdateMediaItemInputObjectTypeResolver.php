<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootUpdateMediaItemInputObjectTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\AbstractUpdateMediaItemInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdateMediaItemInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update the metadata for an attachment', 'media-mutations');
    }
}
