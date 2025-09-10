<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootAddPostTagTermMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostTagMetaMutations\TypeResolvers\ObjectType\AbstractPostTagMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootAddPostTagTermMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of adding meta to a posts\'s tag term', 'tag-mutations');
    }
}
