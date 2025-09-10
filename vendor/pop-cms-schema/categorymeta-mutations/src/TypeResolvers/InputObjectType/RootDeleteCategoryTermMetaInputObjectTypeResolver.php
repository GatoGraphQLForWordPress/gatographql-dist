<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteCategoryTermMetaInputObjectTypeResolver extends \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\AbstractDeleteCategoryTermMetaInputObjectTypeResolver implements \PoPCMSSchema\CategoryMetaMutations\TypeResolvers\InputObjectType\DeleteCategoryTermMetaInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootDeleteCategoryMetaInput';
    }
    protected function addIDInputField() : bool
    {
        return \true;
    }
}
