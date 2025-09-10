<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeleteGenericTagTermMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\AbstractGenericTagMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteGenericTagTermMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta mutation on a tag term', 'tag-mutations');
    }
}
