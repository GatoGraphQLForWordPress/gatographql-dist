<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeResolvers\InputObjectType;

use PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\FilterByTaxonomyTermsInputObjectTypeResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractQueryableInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use stdClass;
/** @internal */
abstract class AbstractFilterCustomPostsByCategoriesInputObjectTypeResolver extends AbstractQueryableInputObjectTypeResolver implements \PoPCMSSchema\Categories\TypeResolvers\InputObjectType\FilterCustomPostsByCategoriesInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\FilterByTaxonomyTermsInputObjectTypeResolver|null
     */
    private $filterByTaxonomyTermsInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver|null
     */
    private $categoryTaxonomyEnumStringScalarTypeResolver;
    public final function setFilterByTaxonomyTermsInputObjectTypeResolver(FilterByTaxonomyTermsInputObjectTypeResolver $filterByTaxonomyTermsInputObjectTypeResolver) : void
    {
        $this->filterByTaxonomyTermsInputObjectTypeResolver = $filterByTaxonomyTermsInputObjectTypeResolver;
    }
    protected final function getFilterByTaxonomyTermsInputObjectTypeResolver() : FilterByTaxonomyTermsInputObjectTypeResolver
    {
        if ($this->filterByTaxonomyTermsInputObjectTypeResolver === null) {
            /** @var FilterByTaxonomyTermsInputObjectTypeResolver */
            $filterByTaxonomyTermsInputObjectTypeResolver = $this->instanceManager->getInstance(FilterByTaxonomyTermsInputObjectTypeResolver::class);
            $this->filterByTaxonomyTermsInputObjectTypeResolver = $filterByTaxonomyTermsInputObjectTypeResolver;
        }
        return $this->filterByTaxonomyTermsInputObjectTypeResolver;
    }
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
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to filter custom posts by categories', 'categories');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge($this->addCategoryTaxonomyFilterInput() ? ['taxonomy' => $this->getCategoryTaxonomyEnumStringScalarTypeResolver()] : [], ['includeBy' => $this->getFilterByTaxonomyTermsInputObjectTypeResolver(), 'excludeBy' => $this->getFilterByTaxonomyTermsInputObjectTypeResolver()]);
    }
    protected abstract function addCategoryTaxonomyFilterInput() : bool;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'taxonomy':
                return $this->__('Category taxonomy', 'categories');
            case 'includeBy':
                return $this->__('Retrieve custom posts which contain categories', 'categories');
            case 'excludeBy':
                return $this->__('Retrieve custom posts which do not contain categories', 'categories');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case 'taxonomy':
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
    /**
     * @param array<string,mixed> $query
     * @param stdClass|stdClass[]|array<stdClass[]> $inputValue
     */
    public function integrateInputValueToFilteringQueryArgs(array &$query, $inputValue) : void
    {
        parent::integrateInputValueToFilteringQueryArgs($query, $inputValue);
        if ($this->addCategoryTaxonomyFilterInput() && isset($inputValue->taxonomy)) {
            $query['category-taxonomy'] = $inputValue->taxonomy;
        }
        if (isset($inputValue->includeBy)) {
            if (isset($inputValue->includeBy->ids)) {
                $query['category-ids'] = $inputValue->includeBy->ids;
            }
            if (isset($inputValue->includeBy->slugs)) {
                $query['category-slugs'] = $inputValue->includeBy->slugs;
            }
        }
        if (isset($inputValue->excludeBy)) {
            if (isset($inputValue->excludeBy->ids)) {
                $query['exclude-category-ids'] = $inputValue->excludeBy->ids;
            }
            if (isset($inputValue->excludeBy->slugs)) {
                $query['exclude-category-slugs'] = $inputValue->excludeBy->slugs;
            }
        }
    }
}
