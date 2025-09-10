<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType;

/** @internal */
class RootSetTagsOnCustomPostMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostTagMutations\TypeResolvers\ObjectType\AbstractGenericTagsMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetTagsOnCustomPostMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of setting tags on a custom post', 'posttag-mutations');
    }
}
