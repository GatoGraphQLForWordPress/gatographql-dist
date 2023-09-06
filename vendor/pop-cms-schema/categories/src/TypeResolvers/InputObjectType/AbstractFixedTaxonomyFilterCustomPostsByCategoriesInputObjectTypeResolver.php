<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\TypeResolvers\InputObjectType;

use stdClass;
abstract class AbstractFixedTaxonomyFilterCustomPostsByCategoriesInputObjectTypeResolver extends \PoPCMSSchema\Categories\TypeResolvers\InputObjectType\AbstractFilterCustomPostsByCategoriesInputObjectTypeResolver
{
    protected function addCategoryTaxonomyFilterInput() : bool
    {
        return \false;
    }
    protected abstract function getCategoryTaxonomyName() : string;
    /**
     * @param array<string,mixed> $query
     * @param stdClass|stdClass[]|array<stdClass[]> $inputValue
     */
    public function integrateInputValueToFilteringQueryArgs(array &$query, $inputValue) : void
    {
        parent::integrateInputValueToFilteringQueryArgs($query, $inputValue);
        $query['category-taxonomy'] = $this->getCategoryTaxonomyName();
    }
}
