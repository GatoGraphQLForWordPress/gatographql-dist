<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootSetUserMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\AbstractUserMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetUserMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a set meta mutation on a user', 'user-mutations');
    }
}
