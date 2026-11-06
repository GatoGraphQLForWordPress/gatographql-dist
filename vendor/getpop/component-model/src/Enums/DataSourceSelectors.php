<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Enums;

/** @internal */
enum DataSourceSelectors : string
{
    case ONLYMODEL = 'onlymodel';
    case MODELANDREQUEST = 'modelandrequest';
}
