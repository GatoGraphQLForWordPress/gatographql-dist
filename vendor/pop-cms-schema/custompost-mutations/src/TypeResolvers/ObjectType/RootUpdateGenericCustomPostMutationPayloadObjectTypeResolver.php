<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdateGenericCustomPostMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType\AbstractGenericCustomPostMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdateCustomPostMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update mutation on a custom post', 'custompost-mutations');
    }
}
