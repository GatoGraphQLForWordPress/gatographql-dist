<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Enums;

/** @internal */
enum DataOutputModes : string
{
    case SPLITBYSOURCES = 'splitbysources';
    case COMBINED = 'combined';
}
