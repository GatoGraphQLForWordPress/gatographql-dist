<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class PostCategoryDeleteMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\AbstractPostCategoryMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostCategoryDeleteMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete nested mutation on a post category', 'category-mutations');
    }
}
