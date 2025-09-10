<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\FilterInputs;

use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;
/** @internal */
class CustomPostTypesFilterInput extends AbstractValueToQueryFilterInput
{
    protected function getQueryArgKey() : string
    {
        return 'custompost-types';
    }
}
