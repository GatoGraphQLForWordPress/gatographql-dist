<?php

declare(strict_types=1);

namespace PoPWPSchema\Meta\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPWPSchema\Meta\Constants\MetaQueryCompareByOperators;
use PoPWPSchema\Meta\TypeResolvers\EnumType\MetaQueryCompareByStringValueOperatorEnumTypeResolver;

class MetaQueryCompareByStringValueInputObjectTypeResolver extends AbstractInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPWPSchema\Meta\TypeResolvers\EnumType\MetaQueryCompareByStringValueOperatorEnumTypeResolver|null
     */
    private $metaQueryCompareByStringValueOperatorEnumTypeResolver;

    final protected function getStringScalarTypeResolver(): StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    final protected function getMetaQueryCompareByStringValueOperatorEnumTypeResolver(): MetaQueryCompareByStringValueOperatorEnumTypeResolver
    {
        if ($this->metaQueryCompareByStringValueOperatorEnumTypeResolver === null) {
            /** @var MetaQueryCompareByStringValueOperatorEnumTypeResolver */
            $metaQueryCompareByStringValueOperatorEnumTypeResolver = $this->instanceManager->getInstance(MetaQueryCompareByStringValueOperatorEnumTypeResolver::class);
            $this->metaQueryCompareByStringValueOperatorEnumTypeResolver = $metaQueryCompareByStringValueOperatorEnumTypeResolver;
        }
        return $this->metaQueryCompareByStringValueOperatorEnumTypeResolver;
    }

    public function getTypeName(): string
    {
        return 'MetaQueryCompareByStringValueInput';
    }

    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers(): array
    {
        return [
            'value' => $this->getStringScalarTypeResolver(),
            'operator' => $this->getMetaQueryCompareByStringValueOperatorEnumTypeResolver(),
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
