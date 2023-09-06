<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\ComponentProcessors\FormInputs;

use PoP\ComponentModel\Component\Component;
use PoP\ComponentModel\ComponentProcessors\AbstractFilterInputComponentProcessor;
use PoP\ComponentModel\ComponentProcessors\DataloadQueryArgsFilterInputComponentProcessorInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\FormInputs\FormMultipleInput;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\Media\FilterInputs\MimeTypesFilterInput;
class FilterInputComponentProcessor extends AbstractFilterInputComponentProcessor implements DataloadQueryArgsFilterInputComponentProcessorInterface
{
    public const COMPONENT_FILTERINPUT_MIME_TYPES = 'filterinput-mime-types';
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Media\FilterInputs\MimeTypesFilterInput|null
     */
    private $mimeTypesFilterInput;
    public final function setStringScalarTypeResolver(StringScalarTypeResolver $stringScalarTypeResolver) : void
    {
        $this->stringScalarTypeResolver = $stringScalarTypeResolver;
    }
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    public final function setMimeTypesFilterInput(MimeTypesFilterInput $mimeTypesFilterInput) : void
    {
        $this->mimeTypesFilterInput = $mimeTypesFilterInput;
    }
    protected final function getMimeTypesFilterInput() : MimeTypesFilterInput
    {
        if ($this->mimeTypesFilterInput === null) {
            /** @var MimeTypesFilterInput */
            $mimeTypesFilterInput = $this->instanceManager->getInstance(MimeTypesFilterInput::class);
            $this->mimeTypesFilterInput = $mimeTypesFilterInput;
        }
        return $this->mimeTypesFilterInput;
    }
    /**
     * @return string[]
     */
    public function getComponentNamesToProcess() : array
    {
        return array(self::COMPONENT_FILTERINPUT_MIME_TYPES);
    }
    public function getFilterInput(Component $component) : ?FilterInputInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_MIME_TYPES:
                return $this->getMimeTypesFilterInput();
            default:
                return null;
        }
    }
    public function getInputClass(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_MIME_TYPES:
                return FormMultipleInput::class;
        }
        return parent::getInputClass($component);
    }
    public function getName(Component $component) : string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_MIME_TYPES:
                return 'mimeTypes';
            default:
                return parent::getName($component);
        }
    }
    public function getFilterInputTypeResolver(Component $component) : InputTypeResolverInterface
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_MIME_TYPES:
                return $this->getStringScalarTypeResolver();
            default:
                return $this->getDefaultSchemaFilterInputTypeResolver();
        }
    }
    public function getFilterInputTypeModifiers(Component $component) : int
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_MIME_TYPES:
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return SchemaTypeModifiers::NONE;
        }
    }
    public function getFilterInputDescription(Component $component) : ?string
    {
        switch ($component->name) {
            case self::COMPONENT_FILTERINPUT_MIME_TYPES:
                return $this->__('Limit results to elements with the given mime types', 'media');
            default:
                return null;
        }
    }
}
