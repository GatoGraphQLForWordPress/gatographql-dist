<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

/** @internal */
class RootCreateGenericCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateGenericCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CreateCategoryTermInputObjectTypeResolverInterface
{
    public function getTypeName() : string
    {
        return 'RootCreateGenericCategoryInput';
    }
    protected function addTaxonomyInputField() : bool
    {
        return \false;
    }
    protected function isNameInputFieldMandatory() : bool
    {
        return \true;
    }
    protected function isTaxonomyInputFieldMandatory() : bool
    {
        return \true;
    }
}
