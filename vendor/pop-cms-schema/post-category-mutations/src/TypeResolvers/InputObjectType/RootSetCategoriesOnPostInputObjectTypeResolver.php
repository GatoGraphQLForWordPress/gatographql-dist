<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetCategoriesOnPostInputObjectTypeResolver extends \PoPCMSSchema\PostCategoryMutations\TypeResolvers\InputObjectType\AbstractSetCategoriesOnPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'RootSetCategoriesOnPostInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \true;
    }
}
