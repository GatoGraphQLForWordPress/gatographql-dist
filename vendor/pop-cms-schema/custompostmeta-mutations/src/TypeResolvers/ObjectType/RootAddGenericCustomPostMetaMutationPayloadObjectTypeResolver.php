<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootAddGenericCustomPostMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\AbstractGenericCustomPostMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootAddGenericCustomPostMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of adding meta to a custom post', 'custompost-mutations');
    }
}
