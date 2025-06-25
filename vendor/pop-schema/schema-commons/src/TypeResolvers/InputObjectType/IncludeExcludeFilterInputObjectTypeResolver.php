<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\InputObjectType;

use PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractOneofQueryableInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
class IncludeExcludeFilterInputObjectTypeResolver extends AbstractOneofQueryableInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput|null
     */
    private $includeFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeFilterInput|null
     */
    private $excludeFilterInput;
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    protected final function getIncludeFilterInput() : IncludeFilterInput
    {
        if ($this->includeFilterInput === null) {
            /** @var IncludeFilterInput */
            $includeFilterInput = $this->instanceManager->getInstance(IncludeFilterInput::class);
            $this->includeFilterInput = $includeFilterInput;
        }
        return $this->includeFilterInput;
    }
    protected final function getExcludeFilterInput() : ExcludeFilterInput
    {
        if ($this->excludeFilterInput === null) {
            /** @var ExcludeFilterInput */
            $excludeFilterInput = $this->instanceManager->getInstance(ExcludeFilterInput::class);
            $this->excludeFilterInput = $excludeFilterInput;
        }
        return $this->excludeFilterInput;
    }
    public function getTypeName() : string
    {
        return 'IncludeExcludeFilterInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Oneof input to filter by including or excluding items', 'schema-commons');
    }
    protected function isOneInputValueMandatory() : bool
    {
        return \false;
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return ['include' => $this->getStringScalarTypeResolver(), 'exclude' => $this->getStringScalarTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'include':
                return $this->__('Names to be included', 'schema-commons');
            case 'exclude':
                return $this->__('Names to be excluded', 'schema-commons');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case 'include':
                return $this->getIncludeFilterInput();
            case 'exclude':
                return $this->getExcludeFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case 'include':
            case 'exclude':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
    protected function isOneOfInputPropertyNullable(string $propertyName) : bool
    {
        switch ($propertyName) {
            case 'include':
            case 'exclude':
                return \true;
            default:
                return parent::isOneOfInputPropertyNullable($propertyName);
        }
    }
}
