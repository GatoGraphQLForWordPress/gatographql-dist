<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetCategoriesOnCustomPostInputObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\AbstractSetCategoriesOnPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetCategoriesOnCustomPostInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \true;
    }
}
