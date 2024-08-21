<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootDeleteGenericCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\AbstractDeleteGenericCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\DeleteCategoryTermInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootDeleteGenericCategoryInput';
    }
    protected function addTaxonomyInputField() : bool
    {
        return \true;
    }
}
