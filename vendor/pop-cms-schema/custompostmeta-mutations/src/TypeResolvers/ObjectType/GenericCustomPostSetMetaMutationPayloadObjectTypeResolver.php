<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class GenericCustomPostSetMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostMetaMutations\TypeResolvers\ObjectType\AbstractGenericCustomPostMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericCustomPostSetMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a set meta nested mutation on a custom post', 'custompost-mutations');
    }
}
