<?php

declare (strict_types=1);
namespace PoPCMSSchema\Taxonomies\FilterInputs;

use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;
/** @internal */
class TaxonomyFilterInput extends AbstractValueToQueryFilterInput
{
    protected function getQueryArgKey() : string
    {
        return 'taxonomy';
    }
}
