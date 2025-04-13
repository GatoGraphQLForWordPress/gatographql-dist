<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdatePostMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostMetaMutations\TypeResolvers\ObjectType\AbstractPostMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdatePostMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update meta mutation on a post', 'custompost-mutations');
    }
}
