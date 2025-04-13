<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdateGenericTagTermMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMetaMutations\TypeResolvers\ObjectType\AbstractGenericTagMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdateGenericTagTermMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update meta mutation on a tag term', 'tag-mutations');
    }
}
