<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\FilterInputs;

use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;
/** @internal */
class CommentStatusFilterInput extends AbstractValueToQueryFilterInput
{
    protected function getQueryArgKey() : string
    {
        return 'status';
    }
}
