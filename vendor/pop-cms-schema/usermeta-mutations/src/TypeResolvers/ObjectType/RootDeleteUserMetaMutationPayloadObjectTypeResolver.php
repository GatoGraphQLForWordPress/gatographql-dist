<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeleteUserMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\AbstractUserMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteUserMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta mutation on a user', 'user-mutations');
    }
}
