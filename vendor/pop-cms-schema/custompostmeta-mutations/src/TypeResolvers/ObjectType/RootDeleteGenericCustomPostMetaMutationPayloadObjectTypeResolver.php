<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeleteGenericCustomPostMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\AbstractGenericCustomPostMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteGenericCustomPostMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta mutation on a custom post', 'custompost-mutations');
    }
}
