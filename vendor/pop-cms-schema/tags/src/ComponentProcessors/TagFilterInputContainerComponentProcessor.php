<?php

declare (strict_types=1);
namespace PoPCMSSchema\Tags\ComponentProcessors;

use PoPCMSSchema\SchemaCommons\ComponentProcessors\AbstractFilterInputContainerComponentProcessor;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\FormInputs\CommonFilterInputComponentProcessor;
use PoPCMSSchema\Tags\ComponentProcessors\FormInputs\FilterInputComponentProcessor;
use PoP\ComponentModel\Component\Component;
class TagFilterInputContainerComponentProcessor extends AbstractFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';
    public const COMPONENT_FILTERINPUTCONTAINER_TAGS = 'filterinputcontainer-tags';
    public const COMPONENT_FILTERINPUTCONTAINER_TAGCOUNT = 'filterinputcontainer-tagcount';
    public const COMPONENT_FILTERINPUTCONTAINER_GENERICTAGS = 'filterinputcontainer-generictags';
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUTCONTAINER_TAGS, self::COMPONENT_FILTERINPUTCONTAINER_TAGCOUNT, self::COMPONENT_FILTERINPUTCONTAINER_GENERICTAGS);
    }
    /**
     * @return Component[]
     */
    public function getFilterInputComponents(Component $component) : array
    {
        $tagFilterInputComponents = \array_merge($this->getIDFilterInputComponents(), [new Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_SEARCH), new Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_SLUGS)]);
        $paginationFilterInputComponents = $this->getPaginationFilterInputComponents();
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUTCONTAINER_TAGS:
                return \array_merge(\is_array($tagFilterInputComponents) ? $tagFilterInputComponents : \iterator_to_array($tagFilterInputComponents), $paginationFilterInputComponents);
            case self::COMPONENT_FILTERINPUTCONTAINER_TAGCOUNT:
                return $tagFilterInputComponents;
            case self::COMPONENT_FILTERINPUTCONTAINER_GENERICTAGS:
                return [new Component(FilterInputComponentProcessor::class, FilterInputComponentProcessor::COMPONENT_FILTERINPUT_GENERIC_TAG_TAXONOMY)];
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
