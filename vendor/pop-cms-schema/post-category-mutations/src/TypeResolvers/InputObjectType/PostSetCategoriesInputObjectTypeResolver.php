<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class PostSetCategoriesInputObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\AbstractSetCategoriesOnPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'PostSetCategoriesInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \false;
    }
}
