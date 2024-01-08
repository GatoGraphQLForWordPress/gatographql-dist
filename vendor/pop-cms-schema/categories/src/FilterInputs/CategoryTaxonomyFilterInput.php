<?php

declare (strict_types=1);
namespace PoPCMSSchema\Categories\FilterInputs;

use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;
/** @internal */
class CategoryTaxonomyFilterInput extends AbstractValueToQueryFilterInput
{
    protected function getQueryArgKey() : string
    {
        return 'category-taxonomy';
    }
}
