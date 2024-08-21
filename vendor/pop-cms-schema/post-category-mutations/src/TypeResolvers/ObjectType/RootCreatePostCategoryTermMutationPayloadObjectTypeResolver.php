<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class RootCreatePostCategoryTermMutationPayloadObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\ObjectType\AbstractPostCategoryMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootCreatePostCategoryTermMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of creating a post category term', 'category-mutations');
    }
}
