<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Variables;

/** @internal */
interface VariableManagerInterface
{
    /**
     * @return array<string,mixed>
     */
    public function getVariablesFromRequest() : array;
}
