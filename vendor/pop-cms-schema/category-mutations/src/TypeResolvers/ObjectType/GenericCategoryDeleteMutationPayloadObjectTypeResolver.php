<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class GenericCategoryDeleteMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType\AbstractGenericCategoryMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericCategoryDeleteMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete nested mutation on a generic category', 'category-mutations');
    }
}
