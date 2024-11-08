<?php

declare(strict_types=1);

namespace PoPWPSchema\Meta\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\NumericScalarTypeResolver;
use PoPWPSchema\Meta\Constants\MetaQueryCompareByOperators;
use PoPWPSchema\Meta\TypeResolvers\EnumType\MetaQueryCompareByNumericValueOperatorEnumTypeResolver;

class MetaQueryCompareByNumericValueInputObjectTypeResolver extends AbstractInputObjectTypeResolver
{
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\NumericScalarTypeResolver|null
     */
    private $anyBuiltInScalarScalarTypeResolver;
    /**
     * @var \PoPWPSchema\Meta\TypeResolvers\EnumType\MetaQueryCompareByNumericValueOperatorEnumTypeResolver|null
     */
    private $metaQueryCompareByNumericValueOperatorEnumTypeResolver;

    final protected function getNumericScalarTypeResolver(): NumericScalarTypeResolver
    {
        if ($this->anyBuiltInScalarScalarTypeResolver === null) {
            /** @var NumericScalarTypeResolver */
            $anyBuiltInScalarScalarTypeResolver = $this->instanceManager->getInstance(NumericScalarTypeResolver::class);
            $this->anyBuiltInScalarScalarTypeResolver = $anyBuiltInScalarScalarTypeResolver;
        }
        return $this->anyBuiltInScalarScalarTypeResolver;
    }
    final protected function getMetaQueryCompareByNumericValueOperatorEnumTypeResolver(): MetaQueryCompareByNumericValueOperatorEnumTypeResolver
    {
        if ($this->metaQueryCompareByNumericValueOperatorEnumTypeResolver === null) {
            /** @var MetaQueryCompareByNumericValueOperatorEnumTypeResolver */
            $metaQueryCompareByNumericValueOperatorEnumTypeResolver = $this->instanceManager->getInstance(MetaQueryCompareByNumericValueOperatorEnumTypeResolver::class);
            $this->metaQueryCompareByNumericValueOperatorEnumTypeResolver = $metaQueryCompareByNumericValueOperatorEnumTypeResolver;
        }
        return $this->metaQueryCompareByNumericValueOperatorEnumTypeResolver;
    }

    public function getTypeName(): string
    {
        return 'MetaQueryCompareByNumericValueInput';
    }

    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers(): array
    {
        return [
            'value' => $this->getNumericScalarTypeResolver(),
            'operator' => $this->getMetaQueryCompareByNumericValueOperatorEnumTypeResolver(),
        ];
    }

    public function getInputFieldDescription(string $inputFieldName): ?string
    {
        switch ($inputFieldName) {
            case 'value':
                return $this->__('Custom field value', 'meta');
            case 'operator':
                return $this->__('The operator to compare against', 'meta');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }

    /**
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case 'operator':
                return MetaQueryCompareByOperators::EQUALS;
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }

    public function getInputFieldTypeModifiers(string $inputFieldName): int
    {
        switch ($inputFieldName) {
            case 'operator':
            case 'value':
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
}
