<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class CategoryTermSetMetaInputObjectTypeResolver extends \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\AbstractSetCategoryTermMetaInputObjectTypeResolver implements \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\SetCategoryTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'CategorySetMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \false;
    }
}
