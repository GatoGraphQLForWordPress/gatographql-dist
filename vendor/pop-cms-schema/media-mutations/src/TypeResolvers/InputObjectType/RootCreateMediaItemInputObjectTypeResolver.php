<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootCreateMediaItemInputObjectTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\AbstractCreateMediaItemInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootCreateMediaItemInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to upload an attachment', 'media-mutations');
    }
}
