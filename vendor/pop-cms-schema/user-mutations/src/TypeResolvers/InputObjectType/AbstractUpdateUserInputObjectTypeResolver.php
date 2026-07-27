<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType;

/** @internal */
abstract class AbstractUpdateUserInputObjectTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateUserInputObjectTypeResolver implements \PoPCMSSchema\UserMutations\TypeResolvers\InputObjectType\UpdateUserInputObjectTypeResolverInterface
{
    protected function addUserInputField() : bool
    {
        return \true;
    }
    protected function addUsernameInputField() : bool
    {
        return \false;
    }
}
