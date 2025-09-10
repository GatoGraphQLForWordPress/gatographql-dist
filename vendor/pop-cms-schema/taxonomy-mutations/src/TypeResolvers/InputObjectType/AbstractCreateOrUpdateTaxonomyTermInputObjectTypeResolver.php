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
    private ?IDScalarTypeResolver $idScalarTypeResolver = null;
    private ?StringScalarTypeResolver $stringScalarTypeResolver = null;
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
        return match ($inputFieldName) {
            MutationInputProperties::ID => $this->__('The ID of the taxonomy to update', 'taxonomy-mutations'),
            MutationInputProperties::NAME => $this->__('The name of the taxonomy', 'taxonomy-mutations'),
            MutationInputProperties::DESCRIPTION => $this->__('The description of the taxonomy', 'taxonomy-mutations'),
            MutationInputProperties::SLUG => $this->__('The slug of the taxonomy', 'taxonomy-mutations'),
            MutationInputProperties::TAXONOMY => $this->__('The taxonomy', 'taxonomy-mutations'),
            MutationInputProperties::PARENT_BY => $this->__('The taxonomy\'s parent, or `null` to remove it', 'taxonomy-mutations'),
            default => parent::getInputFieldDescription($inputFieldName),
        };
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        return match ($inputFieldName) {
            MutationInputProperties::ID => SchemaTypeModifiers::MANDATORY,
            MutationInputProperties::NAME => $this->isNameInputFieldMandatory() ? SchemaTypeModifiers::MANDATORY : SchemaTypeModifiers::NONE,
            MutationInputProperties::TAXONOMY => $this->isTaxonomyInputFieldMandatory() ? SchemaTypeModifiers::MANDATORY : SchemaTypeModifiers::NONE,
            default => parent::getInputFieldTypeModifiers($inputFieldName),
        };
    }
    protected abstract function isNameInputFieldMandatory() : bool;
    protected abstract function isTaxonomyInputFieldMandatory() : bool;
    public function getInputFieldDefaultValue(string $inputFieldName) : mixed
    {
        return match ($inputFieldName) {
            MutationInputProperties::TAXONOMY => $this->getTaxonomyInputFieldDefaultValue(),
            default => parent::getInputFieldDefaultValue($inputFieldName),
        };
    }
    protected abstract function getTaxonomyInputFieldDefaultValue() : mixed;
}
