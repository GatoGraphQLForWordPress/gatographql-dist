<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType;

/** @internal */
class UserDeleteInputObjectTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType\AbstractDeleteUserInputObjectTypeResolver
{
    protected function addIDInputField() : bool
    {
        return \false;
    }
    public function getTypeName() : string
    {
        return 'UserDeleteInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a user (nested mutations)', 'gatographql');
    }
}
