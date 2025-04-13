<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootAddUserMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\UserMetaMutations\TypeResolvers\ObjectType\AbstractUserMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootAddUserMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of adding meta to a user', 'user-mutations');
    }
}
