<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdatePostTagTermMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\AbstractPostTagMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdatePostTagTermMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update mutation on a post tag term', 'tag-mutations');
    }
}
