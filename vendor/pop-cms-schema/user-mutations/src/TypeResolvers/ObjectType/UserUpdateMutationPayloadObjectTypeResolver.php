<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\ObjectType;

/** @internal */
class UserUpdateMutationPayloadObjectTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\ObjectType\AbstractUserMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'UserUpdateMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of updating a user (nested mutations)', 'gatographql');
    }
}
