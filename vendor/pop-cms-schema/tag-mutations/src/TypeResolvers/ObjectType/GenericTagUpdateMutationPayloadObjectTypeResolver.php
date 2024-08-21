<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\ObjectType;

/** @internal */
class GenericTagUpdateMutationPayloadObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\AbstractGenericTagMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericTagUpdateMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update nested mutation on a generic tag', 'tag-mutations');
    }
}
