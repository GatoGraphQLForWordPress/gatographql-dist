<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class UserAddMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\AbstractUserMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'UserAddMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an add meta nested mutation on a user', 'user-mutations');
    }
}
