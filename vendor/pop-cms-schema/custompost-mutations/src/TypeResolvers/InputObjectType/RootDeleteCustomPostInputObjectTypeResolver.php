<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteCustomPostInputObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\InputObjectType\AbstractDeleteCustomPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteCustomPostInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a custom post', 'gatographql');
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
