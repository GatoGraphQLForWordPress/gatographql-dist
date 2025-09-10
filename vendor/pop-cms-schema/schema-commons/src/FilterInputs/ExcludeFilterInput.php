<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\FilterInputs;

use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;
/** @internal */
class ExcludeFilterInput extends AbstractValueToQueryFilterInput
{
    protected function getQueryArgKey() : string
    {
        return 'exclude';
    }
}
