<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class RootSetCategoriesOnCustomPostMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\AbstractGenericCategoriesMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetCategoriesOnCustomPostMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of setting categories on a custom post', 'postcategory-mutations');
    }
}
