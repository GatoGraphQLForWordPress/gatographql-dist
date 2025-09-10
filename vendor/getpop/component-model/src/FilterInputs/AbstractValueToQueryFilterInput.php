<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FilterInputs;

/** @internal */
abstract class AbstractValueToQueryFilterInput extends \PoP\ComponentModel\FilterInputs\AbstractFilterInput
{
    /**
     * @param array<string,mixed> $query
     */
    public final function filterDataloadQueryArgs(array &$query, mixed $value) : void
    {
        if ($value !== null) {
            $value = $this->getValue($value);
        }
        if ($this->avoidSettingValueIfEmpty() && empty($value)) {
            return;
        }
        $query[$this->getQueryArgKey()] = $value;
    }
    protected abstract function getQueryArgKey() : string;
    protected function getValue(mixed $value) : mixed
    {
        return $value;
    }
    protected function avoidSettingValueIfEmpty() : bool
    {
        return \false;
    }
}
