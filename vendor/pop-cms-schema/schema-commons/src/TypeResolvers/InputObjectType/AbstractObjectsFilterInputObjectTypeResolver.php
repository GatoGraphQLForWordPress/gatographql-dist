<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractQueryableInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeIDsFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput;
abstract class AbstractObjectsFilterInputObjectTypeResolver extends AbstractQueryableInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ExcludeIDsFilterInput|null
     */
    private $excludeIDsFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\IncludeFilterInput|null
     */
    private $includeFilterInput;
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
    public final function setExcludeIDsFilterInput(ExcludeIDsFilterInput $excludeIDsFilterInput) : void
    {
        $this->excludeIDsFilterInput = $excludeIDsFilterInput;
    }
    protected final function getExcludeIDsFilterInput() : ExcludeIDsFilterInput
    {
        if ($this->excludeIDsFilterInput === null) {
            /** @var ExcludeIDsFilterInput */
            $excludeIDsFilterInput = $this->instanceManager->getInstance(ExcludeIDsFilterInput::class);
            $this->excludeIDsFilterInput = $excludeIDsFilterInput;
        }
        return $this->excludeIDsFilterInput;
    }
    public final function setIncludeFilterInput(IncludeFilterInput $includeFilterInput) : void
    {
        $this->includeFilterInput = $includeFilterInput;
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
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return ['ids' => $this->getIDScalarTypeResolver(), 'excludeIDs' => $this->getIDScalarTypeResolver()];
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case 'ids':
            case 'excludeIDs':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'ids':
                return $this->__('Limit results to elements with the given IDs', 'schema-commons');
            case 'excludeIDs':
                return $this->__('Exclude elements with the given IDs', 'schema-commons');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case 'ids':
                return $this->getIncludeFilterInput();
            case 'excludeIDs':
                return $this->getExcludeIDsFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
