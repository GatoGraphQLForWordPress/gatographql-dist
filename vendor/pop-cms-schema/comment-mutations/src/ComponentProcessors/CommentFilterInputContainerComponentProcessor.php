<?php

declare (strict_types=1);
namespace PoPCMSSchema\CommentMutations\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoPCMSSchema\Comments\ComponentProcessors\CommentFilterInputContainerComponentProcessor as UpstreamCommentFilterInputContainerComponentProcessor;
class CommentFilterInputContainerComponentProcessor extends UpstreamCommentFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';
    public const COMPONENT_FILTERINPUTCONTAINER_MYCOMMENTS = 'filterinputcontainer-mycomments';
    public const COMPONENT_FILTERINPUTCONTAINER_MYCOMMENTCOUNT = 'filterinputcontainer-mycommentcount';
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUTCONTAINER_MYCOMMENTS, self::COMPONENT_FILTERINPUTCONTAINER_MYCOMMENTCOUNT);
    }
    /**
     * @return Component[]
     */
    public function getFilterInputComponents(Component $component) : array
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUTCONTAINER_MYCOMMENTS:
                $targetComponent = new Component(parent::class, parent::COMPONENT_FILTERINPUTCONTAINER_ADMINCOMMENTS);
                break;
            case self::COMPONENT_FILTERINPUTCONTAINER_MYCOMMENTCOUNT:
                $targetComponent = new Component(parent::class, parent::COMPONENT_FILTERINPUTCONTAINER_ADMINCOMMENTCOUNT);
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
