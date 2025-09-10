<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class PostDeleteMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\AbstractPostMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostDeleteMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta nested mutation on a post', 'custompost-mutations');
    }
}
