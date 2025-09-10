<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType;

/** @internal */
class GenericCustomPostUpdateMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\AbstractGenericCustomPostMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericCustomPostUpdateMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update nested mutation on a generic custom post', 'custompost-mutations');
    }
}
