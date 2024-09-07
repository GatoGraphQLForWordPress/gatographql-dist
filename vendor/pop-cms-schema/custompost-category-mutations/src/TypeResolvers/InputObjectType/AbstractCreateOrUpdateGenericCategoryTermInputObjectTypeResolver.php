<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateCategoryTermInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractCreateOrUpdateGenericCategoryTermInputObjectTypeResolver extends AbstractCreateOrUpdateCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\UpdateGenericCategoryTermInputObjectTypeResolverInterface, \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\CreateGenericCategoryTermInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver|null
     */
    private $categoryTaxonomyEnumStringScalarTypeResolver;
    public final function setCategoryTaxonomyEnumStringScalarTypeResolver(CategoryTaxonomyEnumStringScalarTypeResolver $categoryTaxonomyEnumStringScalarTypeResolver) : void
    {
        $this->categoryTaxonomyEnumStringScalarTypeResolver = $categoryTaxonomyEnumStringScalarTypeResolver;
    }
    protected final function getCategoryTaxonomyEnumStringScalarTypeResolver() : CategoryTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->categoryTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var CategoryTaxonomyEnumStringScalarTypeResolver */
            $categoryTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(CategoryTaxonomyEnumStringScalarTypeResolver::class);
            $this->categoryTaxonomyEnumStringScalarTypeResolver = $categoryTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->categoryTaxonomyEnumStringScalarTypeResolver;
    }
    protected function getTaxonomyInputObjectTypeResolver() : InputTypeResolverInterface
    {
        return $this->getCategoryTaxonomyEnumStringScalarTypeResolver();
    }
    /**
     * @return mixed
     */
    protected function getTaxonomyInputFieldDefaultValue()
    {
        return null;
    }
}
