<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\ObjectType;

/** @internal */
class GenericTagDeleteMutationPayloadObjectTypeResolver extends \PoPCMSSchema\TagMutations\TypeResolvers\ObjectType\AbstractGenericTagMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericTagDeleteMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete nested mutation on a generic tag', 'tag-mutations');
    }
}
