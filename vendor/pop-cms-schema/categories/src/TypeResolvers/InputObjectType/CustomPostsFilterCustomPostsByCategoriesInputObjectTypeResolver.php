<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeResolvers\InputObjectType;

use PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
class CustomPostsFilterCustomPostsByCategoriesInputObjectTypeResolver extends \PoPCMSSchema\Categories\TypeResolvers\InputObjectType\AbstractFilterCustomPostsByCategoriesInputObjectTypeResolver
{
    private ?CategoryTaxonomyEnumStringScalarTypeResolver $categoryTaxonomyEnumStringScalarTypeResolver = null;
    protected final function getCategoryTaxonomyEnumStringScalarTypeResolver() : CategoryTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->categoryTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var CategoryTaxonomyEnumStringScalarTypeResolver */
            $categoryTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(CategoryTaxonomyEnumStringScalarTypeResolver::class);
            $this->categoryTaxonomyEnumStringScalarTypeResolver = $categoryTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->categoryTaxonomyEnumStringScalarTypeResolver;
    }
    public function getTypeName() : string
    {
        return 'FilterCustomPostsByCategoriesInput';
    }
    protected function getCategoryTaxonomyFilterInput() : InputTypeResolverInterface
    {
        return $this->getCategoryTaxonomyEnumStringScalarTypeResolver();
    }
    protected function getCategoryTaxonomyFilterDefaultValue() : mixed
    {
        return null;
    }
}
