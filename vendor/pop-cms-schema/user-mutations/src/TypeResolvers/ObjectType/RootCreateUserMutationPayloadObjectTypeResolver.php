<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeResolvers\ObjectType;

/** @internal */
class RootCreateUserMutationPayloadObjectTypeResolver extends \PoPCMSSchema\UserMutations\TypeResolvers\ObjectType\AbstractUserMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootCreateUserMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of creating a user', 'gatographql');
    }
}
