<?php

declare (strict_types=1);
namespace PoP\ComponentModel\DataStructureFormatters;

/** @internal */
class JSONDataStructureFormatter extends \PoP\ComponentModel\DataStructureFormatters\AbstractJSONDataStructureFormatter
{
    public function getName() : string
    {
        return 'json';
    }
}
