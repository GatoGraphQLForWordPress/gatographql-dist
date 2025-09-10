<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class UserDeleteMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\AbstractUserMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'UserDeleteMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta nested mutation on a user', 'user-mutations');
    }
}
