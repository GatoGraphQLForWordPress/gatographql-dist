<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostTags\ComponentProcessors;

use PoPCMSSchema\PostTags\ComponentProcessors\FormInputs\FilterInputComponentProcessor;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\AbstractFilterInputContainerComponentProcessor;
use PoP\ComponentModel\Component\Component;
/** @internal */
class PostTagFilterInputContainerComponentProcessor extends AbstractFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';
    public const COMPONENT_FILTERINPUTCONTAINER_POSTTAGS = 'filterinputcontainer-posttags';
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUTCONTAINER_POSTTAGS);
    }
    /**
     * @return Component[]
     */
    public function getFilterInputComponents(Component $component) : array
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUTCONTAINER_POSTTAGS:
                return [new Component(FilterInputComponentProcessor::class, FilterInputComponentProcessor::COMPONENT_FILTERINPUT_POST_TAG_TAXONOMY)];
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
