<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeResolvers\InputObjectType;

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
    protected final function getFilterByTaxonomyTermsInputObjectTypeResolver() : FilterByTaxonomyTermsInputObjectTypeResolver
    {
        if ($this->filterByTaxonomyTermsInputObjectTypeResolver === null) {
            /** @var FilterByTaxonomyTermsInputObjectTypeResolver */
            $filterByTaxonomyTermsInputObjectTypeResolver = $this->instanceManager->getInstance(FilterByTaxonomyTermsInputObjectTypeResolver::class);
            $this->filterByTaxonomyTermsInputObjectTypeResolver = $filterByTaxonomyTermsInputObjectTypeResolver;
        }
        return $this->filterByTaxonomyTermsInputObjectTypeResolver;
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
        return ['taxonomy' => $this->getCategoryTaxonomyFilterInput(), 'includeBy' => $this->getFilterByTaxonomyTermsInputObjectTypeResolver(), 'excludeBy' => $this->getFilterByTaxonomyTermsInputObjectTypeResolver()];
    }
    protected abstract function getCategoryTaxonomyFilterInput() : InputTypeResolverInterface;
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
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case 'taxonomy':
                return $this->getCategoryTaxonomyFilterDefaultValue();
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    /**
     * @return mixed
     */
    protected abstract function getCategoryTaxonomyFilterDefaultValue();
    /**
     * @param array<string,mixed> $query
     * @param stdClass|stdClass[]|array<stdClass[]> $inputValue
     */
    public function integrateInputValueToFilteringQueryArgs(array &$query, $inputValue) : void
    {
        parent::integrateInputValueToFilteringQueryArgs($query, $inputValue);
        if (isset($inputValue->taxonomy)) {
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
