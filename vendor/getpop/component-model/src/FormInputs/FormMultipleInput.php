<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FormInputs;

/** @internal */
class FormMultipleInput extends \PoP\ComponentModel\FormInputs\FormInput
{
    public function isMultiple() : bool
    {
        return \true;
    }
}
