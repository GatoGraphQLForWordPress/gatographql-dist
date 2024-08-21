<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class RootUpdateGenericCategoryTermMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType\AbstractGenericCategoryMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootUpdateGenericCategoryTermMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update mutation on a category term', 'category-mutations');
    }
}
