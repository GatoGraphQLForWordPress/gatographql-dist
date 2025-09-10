<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType;

/** @internal */
class RootCreateGenericTagTermMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\AbstractGenericTagMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootCreateGenericTagTermMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of creating a tag term', 'tag-mutations');
    }
}
