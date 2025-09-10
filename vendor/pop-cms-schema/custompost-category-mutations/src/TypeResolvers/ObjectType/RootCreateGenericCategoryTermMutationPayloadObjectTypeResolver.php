<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType;

/** @internal */
class RootCreateGenericCategoryTermMutationPayloadObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\ObjectType\AbstractGenericCategoryMutationPayloadObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootCreateGenericCategoryTermMutationPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Payload of creating a category term', 'category-mutations');
    }
}
