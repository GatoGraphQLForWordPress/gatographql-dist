<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class PostAddMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\AbstractPostMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostAddMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an add meta nested mutation on a post', 'custompost-mutations');
    }
}
