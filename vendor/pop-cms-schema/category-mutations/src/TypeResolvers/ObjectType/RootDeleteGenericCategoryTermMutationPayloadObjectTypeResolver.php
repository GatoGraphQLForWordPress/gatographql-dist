<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeleteGenericCategoryTermMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType\AbstractGenericCategoryMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteGenericCategoryTermMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete mutation on a category term', 'category-mutations');
    }
}
