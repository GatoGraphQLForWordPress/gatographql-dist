<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
/** @internal */
interface FilterInputComponentProcessorInterface extends \PoP\ComponentModel\ComponentProcessors\FormInputComponentProcessorInterface
{
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface;
    public function getFilterInputDescription(Component $component) : ?string;
    /**
     * @return mixed
     */
    public function getFilterInputDefaultValue(Component $component);
    public function getFilterInputTypeModifiers(Component $component) : int;
}
