<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdateGenericCustomPostMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\AbstractGenericCustomPostMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdateGenericCustomPostMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update meta mutation on a custom post', 'custompost-mutations');
    }
}
