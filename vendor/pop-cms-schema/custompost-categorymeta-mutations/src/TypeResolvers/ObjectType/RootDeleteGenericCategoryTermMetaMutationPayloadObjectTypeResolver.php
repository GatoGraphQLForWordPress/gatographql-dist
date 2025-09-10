<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootDeleteGenericCategoryTermMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\AbstractGenericCategoryMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootDeleteGenericCategoryTermMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of executing a delete meta mutation on a category term', 'category-mutations');
    }
}
