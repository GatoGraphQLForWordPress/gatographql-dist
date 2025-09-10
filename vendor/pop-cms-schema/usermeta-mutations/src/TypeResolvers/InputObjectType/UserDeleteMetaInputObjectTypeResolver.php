<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class UserDeleteMetaInputObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\AbstractDeleteUserMetaInputObjectTypeResolver implements \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\DeleteUserMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'UserDeleteMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
