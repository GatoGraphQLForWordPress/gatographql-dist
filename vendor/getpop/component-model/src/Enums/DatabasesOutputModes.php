<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Enums;

/** @internal */
enum DatabasesOutputModes : string
{
    case SPLITBYDATABASES = 'splitbydbs';
    case COMBINED = 'combined';
}
