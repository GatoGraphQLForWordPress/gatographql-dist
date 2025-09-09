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
/** @internal */
abstract class AbstractObjectsFilterInputObjectTypeResolver extends AbstractQueryableInputObjectTypeResolver
{
    private ?IDScalarTypeResolver $idScalarTypeResolver = null;
    private ?ExcludeIDsFilterInput $excludeIDsFilterInput = null;
    private ?IncludeFilterInput $includeFilterInput = null;
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
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
        return match ($inputFieldName) {
            'ids', 'excludeIDs' => SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY,
            default => parent::getInputFieldTypeModifiers($inputFieldName),
        };
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        return match ($inputFieldName) {
            'ids' => $this->__('Limit results to elements with the given IDs', 'schema-commons'),
            'excludeIDs' => $this->__('Exclude elements with the given IDs', 'schema-commons'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        return match ($inputFieldName) {
            'ids' => $this->getIncludeFilterInput(),
            'excludeIDs' => $this->getExcludeIDsFilterInput(),
            default => parent::getInputFieldFilterInput($inputFieldName),
        };
    }
}
