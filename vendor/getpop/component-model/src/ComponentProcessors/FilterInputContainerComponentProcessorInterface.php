<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
interface FilterInputContainerComponentProcessorInterface extends \PoP\ComponentModel\ComponentProcessors\FilterDataComponentProcessorInterface
{
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldFilterInputNameTypeResolvers(Component $component) : array;
    public function getFieldFilterInputDescription(Component $component, string $fieldArgName) : ?string;
    /**
     * @return mixed
     */
    public function getFieldFilterInputDefaultValue(Component $component, string $fieldArgName);
    public function getFieldFilterInputTypeModifiers(Component $component, string $fieldArgName) : int;
    /**
     * @return Component[]
     */
    public function getFilterInputComponents(Component $component) : array;
}
