<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\ComponentProcessors;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\FilterInput\FilterInputHelper;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoPCMSSchema\Comments\ComponentProcessors\FormInputs\FilterInputComponentProcessor;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\AbstractFilterInputContainerComponentProcessor;
use PoPCMSSchema\SchemaCommons\ComponentProcessors\FormInputs\CommonFilterInputComponentProcessor;
class SingleCommentFilterInputContainerComponentProcessor extends AbstractFilterInputContainerComponentProcessor
{
    public const HOOK_FILTER_INPUTS = __CLASS__ . ':filter-inputs';
    public const COMPONENT_FILTERINPUTCONTAINER_COMMENT_STATUS = 'filterinputcontainer-comment-status';
    public const COMPONENT_FILTERINPUTCONTAINER_COMMENT_BY_ID_STATUS = 'filterinputcontainer-comment-by-id-status';
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUTCONTAINER_COMMENT_STATUS, self::COMPONENT_FILTERINPUTCONTAINER_COMMENT_BY_ID_STATUS);
    }
    /**
     * @return Component[]
     */
    public function getFilterInputComponents(Component $component) : array
    {
        switch ((string) $component->name) {
            case self::COMPONENT_FILTERINPUTCONTAINER_COMMENT_STATUS:
                return [new Component(FilterInputComponentProcessor::class, FilterInputComponentProcessor::COMPONENT_FILTERINPUT_COMMENT_STATUS)];
            case self::COMPONENT_FILTERINPUTCONTAINER_COMMENT_BY_ID_STATUS:
                return [new Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_ID), new Component(FilterInputComponentProcessor::class, FilterInputComponentProcessor::COMPONENT_FILTERINPUT_COMMENT_STATUS)];
            default:
                return [];
        }
    }
    public function getFieldFilterInputTypeModifiers(Component $component, string $fieldArgName) : int
    {
        $fieldFilterInputTypeModifiers = parent::getFieldFilterInputTypeModifiers($component, $fieldArgName);
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUTCONTAINER_COMMENT_BY_ID_STATUS:
                $idFilterInputName = FilterInputHelper::getFilterInputName(new Component(CommonFilterInputComponentProcessor::class, CommonFilterInputComponentProcessor::COMPONENT_FILTERINPUT_ID));
                if ($fieldArgName === $idFilterInputName) {
                    return $fieldFilterInputTypeModifiers | SchemaTypeModifiers::MANDATORY;
                }
                break;
        }
        return $fieldFilterInputTypeModifiers;
    }
    /**
     * @return string[]
     */
    protected function getFilterInputHookNames() : array
    {
        return \array_merge(parent::getFilterInputHookNames(), [self::HOOK_FILTER_INPUTS]);
    }
}
