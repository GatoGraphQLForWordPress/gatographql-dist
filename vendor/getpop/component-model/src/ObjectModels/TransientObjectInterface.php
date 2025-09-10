<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectModels;

/** @internal */
interface TransientObjectInterface
{
    public function getID() : int|string;
}
