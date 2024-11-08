<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\TaxonomyMutations\Constants\MutationInputProperties;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
abstract class AbstractCreateOrUpdateTaxonomyTermInputObjectTypeResolver extends AbstractInputObjectTypeResolver implements \PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType\UpdateTaxonomyTermInputObjectTypeResolverInterface, \PoPCMSSchema\TaxonomyMutations\TypeResolvers\InputObjectType\CreateTaxonomyTermInputObjectTypeResolverInterface
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
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
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to create or update a taxonomy term', 'taxonomy-mutations');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge($this->addIDInputField() ? [MutationInputProperties::ID => $this->getIDScalarTypeResolver()] : [], $this->addParentIDInputField() ? [MutationInputProperties::PARENT_BY => $this->getTaxonomyTermParentInputObjectTypeResolver()] : [], [MutationInputProperties::NAME => $this->getStringScalarTypeResolver(), MutationInputProperties::DESCRIPTION => $this->getStringScalarTypeResolver(), MutationInputProperties::SLUG => $this->getStringScalarTypeResolver(), MutationInputProperties::TAXONOMY => $this->getTaxonomyInputObjectTypeResolver()]);
    }
    protected abstract function getTaxonomyTermParentInputObjectTypeResolver() : InputTypeResolverInterface;
    protected abstract function getTaxonomyInputObjectTypeResolver() : InputTypeResolverInterface;
    protected abstract function addIDInputField() : bool;
    protected abstract function addParentIDInputField() : bool;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return $this->__('The ID of the taxonomy to update', 'taxonomy-mutations');
            case MutationInputProperties::NAME:
                return $this->__('The name of the taxonomy', 'taxonomy-mutations');
            case MutationInputProperties::DESCRIPTION:
                return $this->__('The description of the taxonomy', 'taxonomy-mutations');
            case MutationInputProperties::SLUG:
                return $this->__('The slug of the taxonomy', 'taxonomy-mutations');
            case MutationInputProperties::TAXONOMY:
                return $this->__('The taxonomy', 'taxonomy-mutations');
            case MutationInputProperties::PARENT_BY:
                return $this->__('The taxonomy\'s parent, or `null` to remove it', 'taxonomy-mutations');
            default:
                return parent::getInputFieldDescription($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::ID:
                return SchemaTypeModifiers::MANDATORY;
            case MutationInputProperties::NAME:
                return $this->isNameInputFieldMandatory() ? SchemaTypeModifiers::MANDATORY : SchemaTypeModifiers::NONE;
            case MutationInputProperties::TAXONOMY:
                return $this->isTaxonomyInputFieldMandatory() ? SchemaTypeModifiers::MANDATORY : SchemaTypeModifiers::NONE;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
    protected abstract function isNameInputFieldMandatory() : bool;
    protected abstract function isTaxonomyInputFieldMandatory() : bool;
    /**
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case MutationInputProperties::TAXONOMY:
                return $this->getTaxonomyInputFieldDefaultValue();
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    /**
     * @return mixed
     */
    protected abstract function getTaxonomyInputFieldDefaultValue();
}
