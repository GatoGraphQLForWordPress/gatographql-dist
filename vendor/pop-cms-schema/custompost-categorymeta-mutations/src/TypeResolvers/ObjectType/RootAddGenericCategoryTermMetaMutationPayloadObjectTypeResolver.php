<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType;

/** @internal */
class RootAddGenericCategoryTermMetaMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMetaMutations\TypeResolvers\ObjectType\AbstractGenericCategoryMetaMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootAddGenericCategoryTermMetaMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of adding meta to a category term', 'category-mutations');
    }
}
