<?php

declare (strict_types=1);
namespace PoPCMSSchema\Pages\ComponentProcessors;

/** @internal */
class PageFilterInputContainerComponentProcessor extends \PoPCMSSchema\Pages\ComponentProcessors\AbstractPageFilterInputContainerComponentProcessor
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
