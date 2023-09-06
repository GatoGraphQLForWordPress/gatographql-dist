<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoPCMSSchema\Media\ComponentProcessors\FormInputs\FilterInputComponentProcessor;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\AbstractFilterInputContainerComponentProcessor;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\FormInputs\CommonFilterInputComponentProcessor;
class MediaFilterInputContainerComponentProcessor extends AbstractFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';
    public const COMPONENT_FILTERINPUTCONTAINER_MEDIAITEMS = 'filterinputcontainer-media-items';
    public const COMPONENT_FILTERINPUTCONTAINER_MEDIAITEMCOUNT = 'filterinputcontainer-media-item-count';
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUTCONTAINER_MEDIAITEMS, self::COMPONENT_FILTERINPUTCONTAINER_MEDIAITEMCOUNT);
    }
    /**
     * @return Component[]
     */
    public function getFilterInputComponents(Component $component) : array
    {
        $mediaFilterInputComponents = \array_merge($this->getIDFilterInputComponents(), [new Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_SEARCH), new Component(FilterInputComponentProcessor::class, FilterInputComponentProcessor::COMPONENT_FILTERINPUT_MIME_TYPES)]);
        $paginationFilterInputComponents = $this->getPaginationFilterInputComponents();
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUTCONTAINER_MEDIAITEMS:
                return \array_merge(\is_array($mediaFilterInputComponents) ? $mediaFilterInputComponents : \iterator_to_array($mediaFilterInputComponents), $paginationFilterInputComponents);
            case self::COMPONENT_FILTERINPUTCONTAINER_MEDIAITEMCOUNT:
                return \array_merge(\is_array($mediaFilterInputComponents) ? $mediaFilterInputComponents : \iterator_to_array($mediaFilterInputComponents));
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
