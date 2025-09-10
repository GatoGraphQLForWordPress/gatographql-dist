<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class UserUpdateMetaInputObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\AbstractUpdateUserMetaInputObjectTypeResolver implements \PoPCMSSchema\UserMetaMutations\TypeResolvers\InputObjectType\UpdateUserMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'UserUpdateMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
