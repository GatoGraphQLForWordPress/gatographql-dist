<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\FilterInputs;

use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;
/** @internal */
class TagIDsFilterInput extends AbstractValueToQueryFilterInput
{
    protected function getQueryArgKey() : string
    {
        return 'tag-ids';
    }
}
