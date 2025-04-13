<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class PostTagAddMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\AbstractPostTagMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostTagAddMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an add meta nested mutation on a post\'s tag term', 'tag-mutations');
    }
}
