<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Info;

/** @internal */
interface ApplicationInfoInterface
{
    public function getVersion() : string;
}
