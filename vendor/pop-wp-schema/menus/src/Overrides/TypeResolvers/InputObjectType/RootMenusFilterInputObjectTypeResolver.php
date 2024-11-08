<?php

declare(strict_types=1);

namespace PoPWPSchema\Menus\Overrides\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoPCMSSchema\Menus\TypeResolvers\InputObjectType\RootMenusFilterInputObjectTypeResolver as UpstreamRootMenusFilterInputObjectTypeResolver;
use PoPWPSchema\Menus\FilterInputs\LocationsFilterInput;
use PoPWPSchema\Menus\TypeResolvers\ScalarType\MenuLocationEnumStringScalarTypeResolver;

class RootMenusFilterInputObjectTypeResolver extends UpstreamRootMenusFilterInputObjectTypeResolver
{
    /**
     * @var \PoPWPSchema\Menus\TypeResolvers\ScalarType\MenuLocationEnumStringScalarTypeResolver|null
     */
    private $menuLocationEnumStringScalarTypeResolver;
    /**
     * @var \PoPWPSchema\Menus\FilterInputs\LocationsFilterInput|null
     */
    private $locationsFilterInput;

    final protected function getMenuLocationEnumStringTypeResolver(): MenuLocationEnumStringScalarTypeResolver
    {
        if ($this->menuLocationEnumStringScalarTypeResolver === null) {
            /** @var MenuLocationEnumStringScalarTypeResolver */
            $menuLocationEnumStringScalarTypeResolver = $this->instanceManager->getInstance(MenuLocationEnumStringScalarTypeResolver::class);
            $this->menuLocationEnumStringScalarTypeResolver = $menuLocationEnumStringScalarTypeResolver;
        }
        return $this->menuLocationEnumStringScalarTypeResolver;
    }
    final protected function getLocationsFilterInput(): LocationsFilterInput
    {
        if ($this->locationsFilterInput === null) {
            /** @var LocationsFilterInput */
            $locationsFilterInput = $this->instanceManager->getInstance(LocationsFilterInput::class);
            $this->locationsFilterInput = $locationsFilterInput;
        }
        return $this->locationsFilterInput;
    }

    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers(): array
    {
        return array_merge(
            parent::getInputFieldNameTypeResolvers(),
            [
                'locations' => $this->getMenuLocationEnumStringTypeResolver(),
            ],
        );
    }

    public function getInputFieldDescription(string $inputFieldName): ?string
    {
        switch ($inputFieldName) {
            case 'locations':
                return $this->__('Filter menus based on locations', 'menus');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }

    public function getInputFieldTypeModifiers(string $inputFieldName): int
    {
        switch ($inputFieldName) {
            case 'locations':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }

    public function getInputFieldFilterInput(string $inputFieldName): ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case 'locations':
                return $this->getLocationsFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
