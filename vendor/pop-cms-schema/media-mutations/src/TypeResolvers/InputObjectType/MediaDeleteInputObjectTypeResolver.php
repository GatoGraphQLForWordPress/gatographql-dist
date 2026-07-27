<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType;

/** @internal */
class MediaDeleteInputObjectTypeResolver extends \PoPCMSSchema\MediaMutations\TypeResolvers\InputObjectType\AbstractDeleteMediaItemInputObjectTypeResolver
{
    protected function addIDInputField() : bool
    {
        return \false;
    }
    public function getTypeName() : string
    {
        return 'MediaDeleteInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete an attachment (nested mutations)', 'gatographql');
    }
}
