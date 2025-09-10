<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdatePostCategoryTermMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\AbstractPostCategoryMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdatePostCategoryTermMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update mutation on a post category term', 'category-mutations');
    }
}
