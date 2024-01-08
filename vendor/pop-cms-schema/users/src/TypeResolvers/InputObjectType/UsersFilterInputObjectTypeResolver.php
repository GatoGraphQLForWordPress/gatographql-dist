<?php

declare (strict_types=1);
namespace PoPCMSSchema\Users\TypeResolvers\InputObjectType;

/** @internal */
class UsersFilterInputObjectTypeResolver extends \PoPCMSSchema\Users\TypeResolvers\InputObjectType\AbstractUsersFilterInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'UsersFilterInput';
    }
}
