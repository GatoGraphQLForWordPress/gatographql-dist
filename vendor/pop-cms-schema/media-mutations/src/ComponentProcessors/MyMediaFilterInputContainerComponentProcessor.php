<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoPCMSSchema\Media\ComponentProcessors\MediaFilterInputContainerComponentProcessor;
/** @internal */
class MyMediaFilterInputContainerComponentProcessor extends MediaFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';
    public const COMPONENT_FILTERINPUTCONTAINER_MYMEDIAITEMS = 'filterinputcontainer-mymediaitems';
    public const COMPONENT_FILTERINPUTCONTAINER_MYMEDIAITEMCOUNT = 'filterinputcontainer-mymediaitem-count';
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUTCONTAINER_MYMEDIAITEMS, self::COMPONENT_FILTERINPUTCONTAINER_MYMEDIAITEMCOUNT);
    }
    /**
     * @return Component[]
     */
    public function getFilterInputComponents(Component $component) : array
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUTCONTAINER_MYMEDIAITEMS:
                $targetComponent = new Component(parent::class, parent::COMPONENT_FILTERINPUTCONTAINER_MEDIAITEMS);
                break;
            case self::COMPONENT_FILTERINPUTCONTAINER_MYMEDIAITEMCOUNT:
                $targetComponent = new Component(parent::class, parent::COMPONENT_FILTERINPUTCONTAINER_MEDIAITEMCOUNT);
                break;
            default:
                $targetComponent = null;
                break;
        }
        return parent::getFilterInputComponents($targetComponent ?? $component);
    }
    /**
     * @return string[]
     */
    protected function getFilterInputHookNames() : array
    {
        return \array_merge(parent::getFilterInputHookNames(), [self::HOOK_FILTER_INPUTS]);
    }
}
