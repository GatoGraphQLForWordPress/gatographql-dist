<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeleteUserMutationPayloadObjectTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\ObjectType\AbstractUserMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteUserMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of deleting a user', 'gatographql');
    }
}
