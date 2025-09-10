<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType;

/** @internal */
class MediaUpdateInputObjectTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\AbstractUpdateMediaItemInputObjectTypeResolver
{
    protected function addMediaItemInputField() : bool
    {
        return \false;
    }
    public function getTypeName() : string
    {
        return 'MediaUpdateInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update the metadata for an attachment (nested mutations)', 'media-mutations');
    }
}
