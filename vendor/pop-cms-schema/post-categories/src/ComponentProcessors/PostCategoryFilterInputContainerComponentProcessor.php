<?php

declare (strict_types=1);
namespace PoPCMSSchema\PostCategories\ComponentProcessors;

use PoPCMSSchema\Categories\ComponentProcessors\CategoryFilterInputContainerComponentProcessor;
/** @internal */
class PostCategoryFilterInputContainerComponentProcessor extends CategoryFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';
    /**
     * @return string[]
     */
    protected function getFilterInputHookNames() : array
    {
        return \array_merge(parent::getFilterInputHookNames(), [self::HOOK_FILTER_INPUTS]);
    }
}
