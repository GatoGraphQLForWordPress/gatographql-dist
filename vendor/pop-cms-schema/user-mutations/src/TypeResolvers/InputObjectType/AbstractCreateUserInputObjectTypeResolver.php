<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType;

/** @internal */
abstract class AbstractCreateUserInputObjectTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateUserInputObjectTypeResolver implements \PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType\CreateUserInputObjectTypeResolverInterface
{
    protected function addUserInputField() : bool
    {
        return \false;
    }
    protected function addUsernameInputField() : bool
    {
        return \true;
    }
}
