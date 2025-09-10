<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType;

/** @internal */
class RootCreatePostTagTermMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostTagMutations\TypeResolvers\ObjectType\AbstractPostTagMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootCreatePostTagTermMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of creating a post tag term', 'tag-mutations');
    }
}
