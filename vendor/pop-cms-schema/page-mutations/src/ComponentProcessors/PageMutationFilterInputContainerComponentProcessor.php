<?php

declare (strict_types=1);
namespace PoPCMSSchema\PageMutations\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoPCMSSchema\CustomPosts\ComponentProcessors\FormInputs\FilterInputComponentProcessor as CustomPostFilterInputComponentProcessor;
use PoPCMSSchema\Pages\ComponentProcessors\AbstractPageFilterInputContainerComponentProcessor;
use PoPCMSSchema\Pages\ComponentProcessors\PageFilterInputContainerComponentProcessor;
/** @internal */
class PageMutationFilterInputContainerComponentProcessor extends AbstractPageFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';
    public const COMPONENT_FILTERINPUTCONTAINER_MYPAGES = 'filterinputcontainer-mypages';
    public const COMPONENT_FILTERINPUTCONTAINER_MYPAGECOUNT = 'filterinputcontainer-mypagecount';
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUTCONTAINER_MYPAGES, self::COMPONENT_FILTERINPUTCONTAINER_MYPAGECOUNT);
    }
    /**
     * Retrieve the same elements as for Pages, and add the "status" filter
     *
     * @return Component[]
     */
    public function getFilterInputComponents(Component $component) : array
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUTCONTAINER_MYPAGES:
                $targetComponent = self::COMPONENT_FILTERINPUTCONTAINER_PAGELISTLIST;
                break;
            case self::COMPONENT_FILTERINPUTCONTAINER_MYPAGECOUNT:
                $targetComponent = self::COMPONENT_FILTERINPUTCONTAINER_PAGELISTCOUNT;
                break;
            default:
                $targetComponent = null;
                break;
        }
        if ($targetComponent === null) {
            return [];
        }
        $filterInputComponents = parent::getFilterInputComponents(new Component(PageFilterInputContainerComponentProcessor::class, $targetComponent));
        $filterInputComponents[] = new Component(CustomPostFilterInputComponentProcessor::class, CustomPostFilterInputComponentProcessor::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS);
        return $filterInputComponents;
    }
    /**
     * @return string[]
     */
    protected function getFilterInputHookNames() : array
    {
        return \array_merge(parent::getFilterInputHookNames(), [self::HOOK_FILTER_INPUTS]);
    }
}
