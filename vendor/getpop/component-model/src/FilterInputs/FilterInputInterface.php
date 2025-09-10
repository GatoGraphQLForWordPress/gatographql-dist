<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FilterInputs;

/** @internal */
interface FilterInputInterface
{
    /**
     * @param array<string,mixed> $query
     */
    public function filterDataloadQueryArgs(array &$query, mixed $value) : void;
}
