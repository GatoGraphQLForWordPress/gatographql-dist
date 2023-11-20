<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\FilterInputs;

use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;
/** @internal */
class TagTaxonomyFilterInput extends AbstractValueToQueryFilterInput
{
    protected function getQueryArgKey() : string
    {
        return 'tag-taxonomy';
    }
}
