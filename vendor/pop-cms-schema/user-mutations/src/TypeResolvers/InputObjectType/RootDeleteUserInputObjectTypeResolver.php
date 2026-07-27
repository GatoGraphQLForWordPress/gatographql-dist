<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteUserInputObjectTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType\AbstractDeleteUserInputObjectTypeResolver
{
    protected function addIDInputField() : bool
    {
        return \true;
    }
    public function getTypeName() : string
    {
        return 'RootDeleteUserInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to delete a user', 'gatographql');
    }
}
