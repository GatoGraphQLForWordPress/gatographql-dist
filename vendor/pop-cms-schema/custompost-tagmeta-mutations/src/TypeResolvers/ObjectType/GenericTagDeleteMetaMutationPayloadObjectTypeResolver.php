<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class GenericTagDeleteMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\AbstractGenericTagMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericTagDeleteMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta nested mutation on a tag term', 'tag-mutations');
    }
}
