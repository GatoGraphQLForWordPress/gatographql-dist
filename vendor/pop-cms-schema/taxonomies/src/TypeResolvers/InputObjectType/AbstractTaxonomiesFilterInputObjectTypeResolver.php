<?php

declare (strict_types=1);
namespace PoPCMSSchema\Taxonomies\TypeResolvers\InputObjectType;

use PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SlugsFilterInput;
use PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\AbstractObjectsFilterInputObjectTypeResolver;
use PoPCMSSchema\Taxonomies\FilterInputs\HideEmptyFilterInput;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
abstract class AbstractTaxonomiesFilterInputObjectTypeResolver extends AbstractObjectsFilterInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\ParentIDFilterInput|null
     */
    private $parentIDFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput|null
     */
    private $searchFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SlugsFilterInput|null
     */
    private $slugsFilterInput;
    /**
     * @var \PoPCMSSchema\Taxonomies\FilterInputs\HideEmptyFilterInput|null
     */
    private $hideEmptyFilterInput;
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
    public final function setBooleanScalarTypeResolver(BooleanScalarTypeResolver $booleanScalarTypeResolver) : void
    {
        $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
    }
    protected final function getBooleanScalarTypeResolver() : BooleanScalarTypeResolver
    {
        if ($this->booleanScalarTypeResolver === null) {
            /** @var BooleanScalarTypeResolver */
            $booleanScalarTypeResolver = $this->instanceManager->getInstance(BooleanScalarTypeResolver::class);
            $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
        }
        return $this->booleanScalarTypeResolver;
    }
    public final function setParentIDFilterInput(ParentIDFilterInput $parentIDFilterInput) : void
    {
        $this->parentIDFilterInput = $parentIDFilterInput;
    }
    protected final function getParentIDFilterInput() : ParentIDFilterInput
    {
        if ($this->parentIDFilterInput === null) {
            /** @var ParentIDFilterInput */
            $parentIDFilterInput = $this->instanceManager->getInstance(ParentIDFilterInput::class);
            $this->parentIDFilterInput = $parentIDFilterInput;
        }
        return $this->parentIDFilterInput;
    }
    public final function setSearchFilterInput(SearchFilterInput $searchFilterInput) : void
    {
        $this->searchFilterInput = $searchFilterInput;
    }
    protected final function getSearchFilterInput() : SearchFilterInput
    {
        if ($this->searchFilterInput === null) {
            /** @var SearchFilterInput */
            $searchFilterInput = $this->instanceManager->getInstance(SearchFilterInput::class);
            $this->searchFilterInput = $searchFilterInput;
        }
        return $this->searchFilterInput;
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
    public final function setHideEmptyFilterInput(HideEmptyFilterInput $hideEmptyFilterInput) : void
    {
        $this->hideEmptyFilterInput = $hideEmptyFilterInput;
    }
    protected final function getHideEmptyFilterInput() : HideEmptyFilterInput
    {
        if ($this->hideEmptyFilterInput === null) {
            /** @var HideEmptyFilterInput */
            $hideEmptyFilterInput = $this->instanceManager->getInstance(HideEmptyFilterInput::class);
            $this->hideEmptyFilterInput = $hideEmptyFilterInput;
        }
        return $this->hideEmptyFilterInput;
    }
    protected abstract function addParentIDInputField() : bool;
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), ['search' => $this->getStringScalarTypeResolver(), 'slugs' => $this->getStringScalarTypeResolver(), 'hideEmpty' => $this->getBooleanScalarTypeResolver()], $this->addParentIDInputField() ? ['parentID' => $this->getIDScalarTypeResolver()] : []);
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'search':
                return $this->__('Search for taxonomies containing the given string', 'taxonomies');
            case 'slugs':
                return $this->__('Search for taxonomies with the given slugs', 'taxonomies');
            case 'hideEmpty':
                return $this->__('Hide empty taxonomies terms?', 'taxonomies');
            case 'parentID':
                return $this->__('Limit results to taxonomies with the given parent ID. \'0\' means \'no parent\'', 'taxonomies');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case 'slugs':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            case 'hideEmpty':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
    /**
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case 'hideEmpty':
                return \false;
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    public function getInputFieldFilterInput(string $inputFieldName) : ?FilterInputInterface
    {
        switch ($inputFieldName) {
            case 'search':
                return $this->getSearchFilterInput();
            case 'slugs':
                return $this->getSlugsFilterInput();
            case 'hideEmpty':
                return $this->getHideEmptyFilterInput();
            case 'parentID':
                return $this->getParentIDFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
