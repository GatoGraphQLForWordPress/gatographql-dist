<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class GenericCategoryUpdateMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\ObjectType\AbstractGenericCategoryMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericCategoryUpdateMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update nested mutation on a generic category', 'category-mutations');
    }
}
