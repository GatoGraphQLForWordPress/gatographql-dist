<?php

declare (strict_types=1);
namespace PoPCMSSchema\Menus\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SlugsFilterInput;
use PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\AbstractObjectsFilterInputObjectTypeResolver;
/** @internal */
abstract class AbstractMenusFilterInputObjectTypeResolver extends AbstractObjectsFilterInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput|null
     */
    private $seachFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SlugsFilterInput|null
     */
    private $slugsFilterInput;
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
    public final function setSearchFilterInput(SearchFilterInput $seachFilterInput) : void
    {
        $this->seachFilterInput = $seachFilterInput;
    }
    protected final function getSearchFilterInput() : SearchFilterInput
    {
        if ($this->seachFilterInput === null) {
            /** @var SearchFilterInput */
            $seachFilterInput = $this->instanceManager->getInstance(SearchFilterInput::class);
            $this->seachFilterInput = $seachFilterInput;
        }
        return $this->seachFilterInput;
    }
    public final function setSlugsFilterInput(SlugsFilterInput $slugsFilterInput) : void
    {
        $this->slugsFilterInput = $slugsFilterInput;
    }
    protected final function getSlugsFilterInput() : SlugsFilterInput
    {
        if ($this->slugsFilterInput === null) {
            /** @var SlugsFilterInput */
            $slugsFilterInput = $this->instanceManager->getInstance(SlugsFilterInput::class);
            $this->slugsFilterInput = $slugsFilterInput;
        }
        return $this->slugsFilterInput;
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), ['search' => $this->getStringScalarTypeResolver(), 'slugs' => $this->getStringScalarTypeResolver()]);
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'search':
                return $this->__('Filter menus that contain a string', 'menus');
            case 'slugs':
                return $this->__('Filter menus based on slug', 'menus');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case 'slugs':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case 'search':
                return $this->getSearchFilterInput();
            case 'slugs':
                return $this->getSlugsFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
