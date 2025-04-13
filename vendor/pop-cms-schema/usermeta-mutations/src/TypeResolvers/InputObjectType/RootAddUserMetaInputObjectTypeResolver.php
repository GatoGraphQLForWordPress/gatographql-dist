<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootAddUserMetaInputObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\AbstractAddUserMetaInputObjectTypeResolver implements \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\AddUserMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootAddUserMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
