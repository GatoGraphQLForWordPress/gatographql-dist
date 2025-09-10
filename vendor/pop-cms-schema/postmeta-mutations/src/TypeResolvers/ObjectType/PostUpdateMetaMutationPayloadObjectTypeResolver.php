<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class PostUpdateMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\AbstractPostMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostUpdateMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update meta nested mutation on a post', 'custompost-mutations');
    }
}
