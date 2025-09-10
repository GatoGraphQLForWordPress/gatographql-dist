<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetCategoriesOnCustomPostInputObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\AbstractSetCategoriesOnGenericCustomPostInputObjectTypeResolver
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
