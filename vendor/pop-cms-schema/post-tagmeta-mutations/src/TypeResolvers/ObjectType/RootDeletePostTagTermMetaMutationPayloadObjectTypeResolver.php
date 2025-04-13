<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeletePostTagTermMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\AbstractPostTagMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeletePostTagTermMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta mutation on a post\'s tag term', 'tag-mutations');
    }
}
