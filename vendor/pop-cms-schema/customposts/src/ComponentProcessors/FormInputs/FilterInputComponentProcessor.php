<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPosts\ComponentProcessors\FormInputs;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\FormInputs\FormMultipleInput;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoPCMSSchema\CustomPosts\Enums\CustomPostStatus;
use PoPCMSSchema\CustomPosts\FilterInputs\CustomPostStatusFilterInput;
use PoPCMSSchema\CustomPosts\FilterInputs\UnionCustomPostTypesFilterInput;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostEnumStringScalarTypeResolver;
use PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\FilterCustomPostStatusEnumTypeResolver;
/** @internal */
class FilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS = 'filterinput-custompoststatus';
    public const COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES = 'filterinput-unioncustomposttypes';
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\FilterCustomPostStatusEnumTypeResolver|null
     */
    private $filterCustomPostStatusEnumTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\TypeResolvers\EnumType\CustomPostEnumStringScalarTypeResolver|null
     */
    private $customPostEnumStringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPosts\FilterInputs\CustomPostStatusFilterInput|null
     */
    private $customPostStatusFilterInput;
    /**
     * @var \PoPCMSSchema\CustomPosts\FilterInputs\UnionCustomPostTypesFilterInput|null
     */
    private $unionCustomPostTypesFilterInput;
    public final function setFilterCustomPostStatusEnumTypeResolver(FilterCustomPostStatusEnumTypeResolver $filterCustomPostStatusEnumTypeResolver) : void
    {
        $this->filterCustomPostStatusEnumTypeResolver = $filterCustomPostStatusEnumTypeResolver;
    }
    protected final function getFilterCustomPostStatusEnumTypeResolver() : FilterCustomPostStatusEnumTypeResolver
    {
        if ($this->filterCustomPostStatusEnumTypeResolver === null) {
            /** @var FilterCustomPostStatusEnumTypeResolver */
            $filterCustomPostStatusEnumTypeResolver = $this->instanceManager->getInstance(FilterCustomPostStatusEnumTypeResolver::class);
            $this->filterCustomPostStatusEnumTypeResolver = $filterCustomPostStatusEnumTypeResolver;
        }
        return $this->filterCustomPostStatusEnumTypeResolver;
    }
    public final function setCustomPostEnumStringScalarTypeResolver(CustomPostEnumStringScalarTypeResolver $customPostEnumStringScalarTypeResolver) : void
    {
        $this->customPostEnumStringScalarTypeResolver = $customPostEnumStringScalarTypeResolver;
    }
    protected final function getCustomPostEnumStringScalarTypeResolver() : CustomPostEnumStringScalarTypeResolver
    {
        if ($this->customPostEnumStringScalarTypeResolver === null) {
            /** @var CustomPostEnumStringScalarTypeResolver */
            $customPostEnumStringScalarTypeResolver = $this->instanceManager->getInstance(CustomPostEnumStringScalarTypeResolver::class);
            $this->customPostEnumStringScalarTypeResolver = $customPostEnumStringScalarTypeResolver;
        }
        return $this->customPostEnumStringScalarTypeResolver;
    }
    public final function setCustomPostStatusFilterInput(CustomPostStatusFilterInput $customPostStatusFilterInput) : void
    {
        $this->customPostStatusFilterInput = $customPostStatusFilterInput;
    }
    protected final function getCustomPostStatusFilterInput() : CustomPostStatusFilterInput
    {
        if ($this->customPostStatusFilterInput === null) {
            /** @var CustomPostStatusFilterInput */
            $customPostStatusFilterInput = $this->instanceManager->getInstance(CustomPostStatusFilterInput::class);
            $this->customPostStatusFilterInput = $customPostStatusFilterInput;
        }
        return $this->customPostStatusFilterInput;
    }
    public final function setUnionCustomPostTypesFilterInput(UnionCustomPostTypesFilterInput $unionCustomPostTypesFilterInput) : void
    {
        $this->unionCustomPostTypesFilterInput = $unionCustomPostTypesFilterInput;
    }
    protected final function getUnionCustomPostTypesFilterInput() : UnionCustomPostTypesFilterInput
    {
        if ($this->unionCustomPostTypesFilterInput === null) {
            /** @var UnionCustomPostTypesFilterInput */
            $unionCustomPostTypesFilterInput = $this->instanceManager->getInstance(UnionCustomPostTypesFilterInput::class);
            $this->unionCustomPostTypesFilterInput = $unionCustomPostTypesFilterInput;
        }
        return $this->unionCustomPostTypesFilterInput;
    }
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS, self::COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS:
                return $this->getCustomPostStatusFilterInput();
            case self::COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES:
                return $this->getUnionCustomPostTypesFilterInput();
            default:
                return null;
        }
    }
    public function getInputClass(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS:
            case self::COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES:
                return FormMultipleInput::class;
        }
        return parent::getInputClass($component);
    }
    public function getName(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS:
            case self::COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES:
                // Add a nice name, so that the URL params when filtering make sense
                $names = array(self::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS => 'status', self::COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES => 'customPostTypes');
                return $names[$component->name];
        }
        return parent::getName($component);
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS:
                return $this->getFilterCustomPostStatusEnumTypeResolver();
            case self::COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES:
                return $this->getCustomPostEnumStringScalarTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS:
            case self::COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return SchemaTypeModifiers::NONE;
        }
    }
    /**
     * @return mixed
     */
    public function getFilterInputDefaultValue(Component $component)
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS:
                return [CustomPostStatus::PUBLISH];
            case self::COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES:
                return $this->getCustomPostEnumStringScalarTypeResolver()->getConsolidatedPossibleValues();
            default:
                return null;
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOSTSTATUS:
                return $this->__('Custom Post Status', 'customposts');
            case self::COMPONENT_FILTERINPUT_UNIONCUSTOMPOSTTYPES:
                return $this->__('Return results from Union of the Custom Post Types', 'customposts');
            default:
                return null;
        }
    }
}
