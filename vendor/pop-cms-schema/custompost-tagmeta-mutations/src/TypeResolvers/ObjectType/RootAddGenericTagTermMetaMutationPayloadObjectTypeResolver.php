<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootAddGenericTagTermMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\AbstractGenericTagMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootAddGenericTagTermMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of adding meta to a tag term', 'tag-mutations');
    }
}
