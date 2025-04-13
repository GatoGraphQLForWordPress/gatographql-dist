<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootSetCategoryTermMetaInputObjectTypeResolver extends \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\AbstractSetCategoryTermMetaInputObjectTypeResolver implements \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\SetCategoryTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootSetCategoryMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
