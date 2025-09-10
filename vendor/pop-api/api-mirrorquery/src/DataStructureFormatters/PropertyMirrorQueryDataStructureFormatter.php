<?php

declare (strict_types=1);
namespace PoPAPI\APIMirrorQuery\DataStructureFormatters;

use PoP\ComponentModel\DataStructureFormatters\PropertyDataStructureFormatterTrait;
/** @internal */
class PropertyMirrorQueryDataStructureFormatter extends \PoPAPI\APIMirrorQuery\DataStructureFormatters\MirrorQueryDataStructureFormatter
{
    use PropertyDataStructureFormatterTrait;
    public function getName() : string
    {
        return 'props';
    }
}
