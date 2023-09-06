<?php

declare (strict_types=1);
namespace PoPCMSSchema\Comments\ConditionalOnModule\Users\ComponentProcessors\FormInputs;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoPCMSSchema\Comments\ConditionalOnModule\Users\FilterInputs\CustomPostAuthorIDsFilterInput;
use PoPCMSSchema\Comments\ConditionalOnModule\Users\FilterInputs\ExcludeCustomPostAuthorIDsFilterInput;
class FilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_CUSTOMPOST_AUTHOR_IDS = 'filterinput-custompost-author-ids';
    public const COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_AUTHOR_IDS = 'filterinput-exclude-custompost-author-ids';
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Comments\ConditionalOnModule\Users\FilterInputs\CustomPostAuthorIDsFilterInput|null
     */
    private $customPostAuthorIDsFilterInput;
    /**
     * @var \PoPCMSSchema\Comments\ConditionalOnModule\Users\FilterInputs\ExcludeCustomPostAuthorIDsFilterInput|null
     */
    private $excludeCustomPostAuthorIDsFilterInput;
    public final function setIDScalarTypeResolver(IDScalarTypeResolver $idScalarTypeResolver) : void
    {
        $this->idScalarTypeResolver = $idScalarTypeResolver;
    }
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
    }
    public final function setCustomPostAuthorIDsFilterInput(CustomPostAuthorIDsFilterInput $customPostAuthorIDsFilterInput) : void
    {
        $this->customPostAuthorIDsFilterInput = $customPostAuthorIDsFilterInput;
    }
    protected final function getCustomPostAuthorIDsFilterInput() : CustomPostAuthorIDsFilterInput
    {
        if ($this->customPostAuthorIDsFilterInput === null) {
            /** @var CustomPostAuthorIDsFilterInput */
            $customPostAuthorIDsFilterInput = $this->instanceManager->getInstance(CustomPostAuthorIDsFilterInput::class);
            $this->customPostAuthorIDsFilterInput = $customPostAuthorIDsFilterInput;
        }
        return $this->customPostAuthorIDsFilterInput;
    }
    public final function setExcludeCustomPostAuthorIDsFilterInput(ExcludeCustomPostAuthorIDsFilterInput $excludeCustomPostAuthorIDsFilterInput) : void
    {
        $this->excludeCustomPostAuthorIDsFilterInput = $excludeCustomPostAuthorIDsFilterInput;
    }
    protected final function getExcludeCustomPostAuthorIDsFilterInput() : ExcludeCustomPostAuthorIDsFilterInput
    {
        if ($this->excludeCustomPostAuthorIDsFilterInput === null) {
            /** @var ExcludeCustomPostAuthorIDsFilterInput */
            $excludeCustomPostAuthorIDsFilterInput = $this->instanceManager->getInstance(ExcludeCustomPostAuthorIDsFilterInput::class);
            $this->excludeCustomPostAuthorIDsFilterInput = $excludeCustomPostAuthorIDsFilterInput;
        }
        return $this->excludeCustomPostAuthorIDsFilterInput;
    }
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_CUSTOMPOST_AUTHOR_IDS, self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_AUTHOR_IDS);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_AUTHOR_IDS:
                return $this->getCustomPostAuthorIDsFilterInput();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_AUTHOR_IDS:
                return $this->getExcludeCustomPostAuthorIDsFilterInput();
            default:
                return null;
        }
    }
    public function getName(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_AUTHOR_IDS:
                return 'customPostAuthorIDs';
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_AUTHOR_IDS:
                return 'excludeCustomPostAuthorIDs';
            default:
                return parent::getName($component);
        }
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_AUTHOR_IDS:
                return $this->getIDScalarTypeResolver();
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_AUTHOR_IDS:
                return $this->getIDScalarTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_AUTHOR_IDS:
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_AUTHOR_IDS:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return SchemaTypeModifiers::NONE;
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_CUSTOMPOST_AUTHOR_IDS:
                return $this->__('Get results from the authors with given IDs', 'pop-users');
            case self::COMPONENT_FILTERINPUT_EXCLUDE_CUSTOMPOST_AUTHOR_IDS:
                return $this->__('Get results from the ones from authors with given IDs', 'pop-users');
            default:
                return null;
        }
    }
}
