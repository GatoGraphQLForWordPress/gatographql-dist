<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class UserSetMetaInputObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\AbstractSetUserMetaInputObjectTypeResolver implements \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\SetUserMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'UserSetMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
