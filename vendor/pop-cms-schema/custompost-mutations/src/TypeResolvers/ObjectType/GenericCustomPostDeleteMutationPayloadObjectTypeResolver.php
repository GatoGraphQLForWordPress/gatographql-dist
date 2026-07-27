<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType;

/** @internal */
class GenericCustomPostDeleteMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\AbstractGenericCustomPostMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericCustomPostDeleteMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete mutation on a custom post', 'gatographql');
    }
}
