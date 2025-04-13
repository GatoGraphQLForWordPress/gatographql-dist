<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeletePostMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\AbstractPostMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeletePostMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta mutation on a post', 'custompost-mutations');
    }
}
