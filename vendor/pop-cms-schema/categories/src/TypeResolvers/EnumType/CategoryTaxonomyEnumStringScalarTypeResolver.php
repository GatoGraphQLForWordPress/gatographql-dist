<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeResolvers\EnumType;

/** @internal */
class CategoryTaxonomyEnumStringScalarTypeResolver extends \PoPCMSSchema\Categories\TypeResolvers\EnumType\AbstractCategoryTaxonomyEnumStringScalarTypeResolver
{
    public function getTypeName() : string
    {
        return 'CategoryTaxonomyEnumString';
    }
    protected function getRegisteredCustomPostCategoryTaxonomyNames() : ?array
    {
        return null;
    }
}
