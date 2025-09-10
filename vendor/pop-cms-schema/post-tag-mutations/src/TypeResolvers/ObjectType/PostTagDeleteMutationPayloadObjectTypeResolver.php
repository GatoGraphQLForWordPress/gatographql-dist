<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType;

/** @internal */
class PostTagDeleteMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\AbstractPostTagMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostTagDeleteMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete nested mutation on a post tag', 'tag-mutations');
    }
}
