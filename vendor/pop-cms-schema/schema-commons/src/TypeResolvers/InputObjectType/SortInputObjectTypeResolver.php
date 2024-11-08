<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractQueryableInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\SchemaCommons\FilterInputs\OrderByFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\OrderFilterInput;
use PoPCMSSchema\SchemaCommons\TypeResolvers\EnumType\OrderEnumTypeResolver;
use PoPSchema\SchemaCommons\Constants\Order;
/** @internal */
class SortInputObjectTypeResolver extends AbstractQueryableInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\TypeResolvers\EnumType\OrderEnumTypeResolver|null
     */
    private $orderEnumTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\OrderByFilterInput|null
     */
    private $excludeIDsFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\OrderFilterInput|null
     */
    private $includeFilterInput;
    protected final function getStringScalarTypeResolver() : StringScalarTypeResolver
    {
        if ($this->stringScalarTypeResolver === null) {
            /** @var StringScalarTypeResolver */
            $stringScalarTypeResolver = $this->instanceManager->getInstance(StringScalarTypeResolver::class);
            $this->stringScalarTypeResolver = $stringScalarTypeResolver;
        }
        return $this->stringScalarTypeResolver;
    }
    protected final function getOrderEnumTypeResolver() : OrderEnumTypeResolver
    {
        if ($this->orderEnumTypeResolver === null) {
            /** @var OrderEnumTypeResolver */
            $orderEnumTypeResolver = $this->instanceManager->getInstance(OrderEnumTypeResolver::class);
            $this->orderEnumTypeResolver = $orderEnumTypeResolver;
        }
        return $this->orderEnumTypeResolver;
    }
    protected final function getOrderByFilterInput() : OrderByFilterInput
    {
        if ($this->excludeIDsFilterInput === null) {
            /** @var OrderByFilterInput */
            $excludeIDsFilterInput = $this->instanceManager->getInstance(OrderByFilterInput::class);
            $this->excludeIDsFilterInput = $excludeIDsFilterInput;
        }
        return $this->excludeIDsFilterInput;
    }
    protected final function getOrderFilterInput() : OrderFilterInput
    {
        if ($this->includeFilterInput === null) {
            /** @var OrderFilterInput */
            $includeFilterInput = $this->instanceManager->getInstance(OrderFilterInput::class);
            $this->includeFilterInput = $includeFilterInput;
        }
        return $this->includeFilterInput;
    }
    public function getTypeName() : string
    {
        return 'SortInput';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to sort custom posts', 'customposts');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return ['order' => $this->getOrderEnumTypeResolver(), 'by' => $this->getStringScalarTypeResolver()];
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'order':
                return $this->__('Sorting direction', 'schema-commons');
            case 'by':
                return $this->__('Property to order by', 'schema-commons');
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
            case 'order':
                return Order::DESC;
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case 'order':
                return $this->getOrderFilterInput();
            case 'by':
                return $this->getOrderByFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
