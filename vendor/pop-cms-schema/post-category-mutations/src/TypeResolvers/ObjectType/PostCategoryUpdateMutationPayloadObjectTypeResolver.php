<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class PostCategoryUpdateMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\AbstractPostCategoryMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostCategoryUpdateMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update nested mutation on a post category', 'category-mutations');
    }
}
