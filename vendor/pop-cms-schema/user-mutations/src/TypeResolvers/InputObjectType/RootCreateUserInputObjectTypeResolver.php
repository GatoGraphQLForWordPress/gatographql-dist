<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootCreateUserInputObjectTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType\AbstractCreateUserInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootCreateUserInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to create a user', 'gatographql');
    }
}
