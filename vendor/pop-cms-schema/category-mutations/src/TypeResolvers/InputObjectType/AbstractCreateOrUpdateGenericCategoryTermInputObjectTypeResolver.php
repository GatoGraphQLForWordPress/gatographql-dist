<?php

declare (strict_types=1);
namespace PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType\MutateGenericTaxonomyTermInputObjectTypeResolverTrait;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
abstract class AbstractCreateOrUpdateGenericCategoryTermInputObjectTypeResolver extends \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\AbstractCreateOrUpdateCategoryTermInputObjectTypeResolver implements \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\UpdateGenericCategoryTermInputObjectTypeResolverInterface, \PoPCMSSchema\CategoryMutations\TypeResolvers\InputObjectType\CreateGenericCategoryTermInputObjectTypeResolverInterface
{
    use MutateGenericTaxonomyTermInputObjectTypeResolverTrait;
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
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), $this->getGenericTaxonomyTermInputFieldNameTypeResolvers());
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return $this->getGenericTaxonomyTermInputFieldDescription($inputFieldName) ?? parent::getInputFieldDescription($inputFieldName);
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        return $this->getGenericTaxonomyTermInputFieldTypeModifiers($inputFieldName) ?? parent::getInputFieldTypeModifiers($inputFieldName);
    }
    protected function getGenericTaxonomyTermTaxonomyInputTypeResolver() : InputTypeResolverInterface
    {
        return $this->getCategoryTaxonomyEnumStringScalarTypeResolver();
    }
}
