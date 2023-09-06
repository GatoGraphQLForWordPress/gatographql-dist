<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeResolvers\InputObjectType;

class CustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver extends \PoPCMSSchema\Categories\TypeResolvers\InputObjectType\AbstractFilterCustomPostsByCategoriesInputObjectTypeResolver
{
    public function getTypeName() : string
    {
        return 'FilterCustomPostsByCategoriesInput';
    }
    protected function addCategoryTaxonomyFilterInput() : bool
    {
        return \true;
    }
}
