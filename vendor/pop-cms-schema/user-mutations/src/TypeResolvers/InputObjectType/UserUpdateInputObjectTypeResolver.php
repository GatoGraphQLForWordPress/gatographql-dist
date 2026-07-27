<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType;

/** @internal */
class UserUpdateInputObjectTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType\AbstractUpdateUserInputObjectTypeResolver
{
    protected function addUserInputField() : bool
    {
        return \false;
    }
    public function getTypeName() : string
    {
        return 'UserUpdateInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to update a user (nested mutations)', 'gatographql');
    }
}
