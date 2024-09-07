<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategories\ComponentProcessors;

use PoPCMSSchema\PostCategories\ComponentProcessors\FormInputs\FilterInputComponentProcessor;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\AbstractFilterInputContainerComponentProcessor;
use PoP\ComponentModel\Component\Component;
/** @internal */
class PostCategoryFilterInputContainerComponentProcessor extends AbstractFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';
    public const COMPONENT_FILTERINPUTCONTAINER_POSTCATEGORIES = 'filterinputcontainer-postcategories';
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUTCONTAINER_POSTCATEGORIES);
    }
    /**
     * @return Component[]
     */
    public function getFilterInputComponents(Component $component) : array
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUTCONTAINER_POSTCATEGORIES:
                return [new Component(FilterInputComponentProcessor::class, FilterInputComponentProcessor::COMPONENT_FILTERINPUT_POST_CATEGORY_TAXONOMY)];
            default:
                return [];
        }
    }
    /**
     * @return string[]
     */
    protected function getFilterInputHookNames() : array
    {
        return \array_merge(parent::getFilterInputHookNames(), [self::HOOK_FILTER_INPUTS]);
    }
}
