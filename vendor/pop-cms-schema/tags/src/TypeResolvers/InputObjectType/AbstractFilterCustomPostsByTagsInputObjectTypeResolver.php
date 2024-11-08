<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\TypeResolvers\InputObjectType;

use PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType\FilterByTaxonomyTermsInputObjectTypeResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractQueryableInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use stdClass;
/** @internal */
abstract class AbstractFilterCustomPostsByTagsInputObjectTypeResolver extends AbstractQueryableInputObjectTypeResolver implements \PoPCMSSchema\Tags\TypeResolvers\InputObjectType\FilterCustomPostsByTagsInputObjectTypeResolverInterface
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
        return $this->__('Input to filter custom posts by tags', 'tags');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return ['taxonomy' => $this->getTagTaxonomyFilterInput(), 'includeBy' => $this->getFilterByTaxonomyTermsInputObjectTypeResolver(), 'excludeBy' => $this->getFilterByTaxonomyTermsInputObjectTypeResolver()];
    }
    protected abstract function getTagTaxonomyFilterInput() : InputTypeResolverInterface;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'taxonomy':
                return $this->__('Tag taxonomy', 'tags');
            case 'includeBy':
                return $this->__('Retrieve custom posts which contain tags', 'tags');
            case 'excludeBy':
                return $this->__('Retrieve custom posts which do not contain tags', 'tags');
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
                return $this->getTagTaxonomyFilterDefaultValue();
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    /**
     * @return mixed
     */
    protected abstract function getTagTaxonomyFilterDefaultValue();
    /**
     * @param array<string,mixed> $query
     * @param stdClass|stdClass[]|array<stdClass[]> $inputValue
     */
    public function integrateInputValueToFilteringQueryArgs(array &$query, $inputValue) : void
    {
        parent::integrateInputValueToFilteringQueryArgs($query, $inputValue);
        if (isset($inputValue->taxonomy)) {
            $query['tag-taxonomy'] = $inputValue->taxonomy;
        }
        if (isset($inputValue->includeBy)) {
            if (isset($inputValue->includeBy->ids)) {
                $query['tag-ids'] = $inputValue->includeBy->ids;
            }
            if (isset($inputValue->includeBy->slugs)) {
                $query['tag-slugs'] = $inputValue->includeBy->slugs;
            }
        }
        if (isset($inputValue->excludeBy)) {
            if (isset($inputValue->excludeBy->ids)) {
                $query['exclude-tag-ids'] = $inputValue->excludeBy->ids;
            }
            if (isset($inputValue->excludeBy->slugs)) {
                $query['exclude-tag-slugs'] = $inputValue->excludeBy->slugs;
            }
        }
    }
}
