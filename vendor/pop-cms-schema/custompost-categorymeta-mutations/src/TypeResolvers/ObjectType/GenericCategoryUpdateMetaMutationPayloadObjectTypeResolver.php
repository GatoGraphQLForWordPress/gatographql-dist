<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class GenericCategoryUpdateMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\AbstractGenericCategoryMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericCategoryUpdateMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing an update meta nested mutation on a category term', 'category-mutations');
    }
}
