<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class CategoryTermUpdateMetaInputObjectTypeResolver extends \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\AbstractUpdateCategoryTermMetaInputObjectTypeResolver implements \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\UpdateCategoryTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'CategoryUpdateMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
