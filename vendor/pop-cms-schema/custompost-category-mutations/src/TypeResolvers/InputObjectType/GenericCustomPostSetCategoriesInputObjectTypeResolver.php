<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class GenericCustomPostSetCategoriesInputObjectTypeResolver extends \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\AbstractSetCategoriesOnGenericCustomPostInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'GenericCustomPostSetCategoriesInput';
    }
    protected function addCustomPostInputField() : bool
    {
        return \false;
    }
}
