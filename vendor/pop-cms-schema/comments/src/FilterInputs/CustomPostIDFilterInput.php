<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\FilterInputs;

use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;
/** @internal */
class CustomPostIDFilterInput extends AbstractValueToQueryFilterInput
{
    protected function getQueryArgKey() : string
    {
        return 'customPostID';
    }
}
