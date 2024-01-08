<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
/** @internal */
interface FormInputComponentProcessorInterface
{
    /**
     * @param array<string,mixed>|null $source
     * @return mixed
     */
    public function getValue(Component $component, ?array $source = null);
    /**
     * @param array<string,mixed> $props
     * @return mixed
     */
    public function getDefaultValue(Component $component, array &$props);
    public function getName(Component $component) : string;
    public function getInputName(Component $component) : string;
    public function isMultiple(Component $component) : bool;
    /**
     * @param array<string,mixed>|null $source
     * @return mixed
     */
    public function isInputSetInSource(Component $component, ?array $source = null);
}
