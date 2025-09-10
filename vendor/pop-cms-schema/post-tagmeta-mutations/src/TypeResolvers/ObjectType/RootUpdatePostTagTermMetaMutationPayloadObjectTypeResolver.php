<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdatePostTagTermMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\AbstractPostTagMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdatePostTagTermMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update meta mutation on a post\'s tag term', 'tag-mutations');
    }
}
