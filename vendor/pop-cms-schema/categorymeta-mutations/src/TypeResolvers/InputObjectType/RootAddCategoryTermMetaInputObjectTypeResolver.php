<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootAddCategoryTermMetaInputObjectTypeResolver extends \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\AbstractAddCategoryTermMetaInputObjectTypeResolver implements \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\AddCategoryTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootAddCategoryMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
