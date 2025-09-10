<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType;

/** @internal */
class PostTagUpdateMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\AbstractPostTagMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostTagUpdateMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update nested mutation on a post tag', 'tag-mutations');
    }
}
