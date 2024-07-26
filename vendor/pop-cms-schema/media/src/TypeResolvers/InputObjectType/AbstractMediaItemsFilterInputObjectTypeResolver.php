<?php

declare (strict_types=1);
namespace PoPCMSSchema\Media\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FilterInputs\FilterInputInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\Media\FilterInputs\MimeTypesFilterInput;
use PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput;
use PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\AbstractObjectsFilterInputObjectTypeResolver;
use PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\DateQueryInputObjectTypeResolver;
/** @internal */
abstract class AbstractMediaItemsFilterInputObjectTypeResolver extends AbstractObjectsFilterInputObjectTypeResolver implements \PoPCMSSchema\Media\TypeResolvers\InputObjectType\MediaItemsFilterInputObjectTypeResolverInterface
{
    /**
     * @var \PoPCMSSchema\SchemaCommons\TypeResolvers\InputObjectType\DateQueryInputObjectTypeResolver|null
     */
    private $dateQueryInputObjectTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Media\FilterInputs\MimeTypesFilterInput|null
     */
    private $mimeTypesFilterInput;
    /**
     * @var \PoPCMSSchema\SchemaCommons\FilterInputs\SearchFilterInput|null
     */
    private $searchFilterInput;
    public final function setDateQueryInputObjectTypeResolver(DateQueryInputObjectTypeResolver $dateQueryInputObjectTypeResolver) : void
    {
        $this->dateQueryInputObjectTypeResolver = $dateQueryInputObjectTypeResolver;
    }
    protected final function getDateQueryInputObjectTypeResolver() : DateQueryInputObjectTypeResolver
    {
        if ($this->dateQueryInputObjectTypeResolver === null) {
            /** @var DateQueryInputObjectTypeResolver */
            $dateQueryInputObjectTypeResolver = $this->instanceManager->getInstance(DateQueryInputObjectTypeResolver::class);
            $this->dateQueryInputObjectTypeResolver = $dateQueryInputObjectTypeResolver;
        }
        return $this->dateQueryInputObjectTypeResolver;
    }
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
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge(parent::getInputFieldNameTypeResolvers(), ['search' => $this->getStringScalarTypeResolver(), 'dateQuery' => $this->getDateQueryInputObjectTypeResolver(), 'mimeTypes' => $this->getStringScalarTypeResolver()]);
    }
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case 'search':
                return $this->__('Search for comments containing the given string', 'comments');
            case 'dateQuery':
                return $this->__('Filter comments based on date', 'comments');
            case 'mimeTypes':
                return $this->__('Filter comments based on type', 'comments');
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
            case 'mimeTypes':
                return ['image'];
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case 'mimeTypes':
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
            case 'mimeTypes':
                return $this->getMimeTypesFilterInput();
            default:
                return parent::getInputFieldFilterInput($inputFieldName);
        }
    }
}
