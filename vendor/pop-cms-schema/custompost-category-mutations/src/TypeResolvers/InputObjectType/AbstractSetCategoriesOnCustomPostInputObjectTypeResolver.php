<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType;

use PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver;
use PoPCMSSchema\Categories\TypeResolvers\ObjectType\CategoryObjectTypeResolverInterface;
use PoPCMSSchema\CustomPostCategoryMutations\Constants\MutationInputProperties;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
/** @internal */
abstract class AbstractSetCategoriesOnCustomPostInputObjectTypeResolver extends AbstractInputObjectTypeResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\CategoriesByOneofInputObjectTypeResolver|null
     */
    private $categoriesByOneofInputObjectTypeResolver;
    /**
     * @var \PoPCMSSchema\Categories\TypeResolvers\EnumType\CategoryTaxonomyEnumStringScalarTypeResolver|null
     */
    private $categoryTaxonomyEnumStringScalarTypeResolver;
    protected final function getBooleanScalarTypeResolver() : BooleanScalarTypeResolver
    {
        if ($this->booleanScalarTypeResolver === null) {
            /** @var BooleanScalarTypeResolver */
            $booleanScalarTypeResolver = $this->instanceManager->getInstance(BooleanScalarTypeResolver::class);
            $this->booleanScalarTypeResolver = $booleanScalarTypeResolver;
        }
        return $this->booleanScalarTypeResolver;
    }
    protected final function getIDScalarTypeResolver() : IDScalarTypeResolver
    {
        if ($this->idScalarTypeResolver === null) {
            /** @var IDScalarTypeResolver */
            $idScalarTypeResolver = $this->instanceManager->getInstance(IDScalarTypeResolver::class);
            $this->idScalarTypeResolver = $idScalarTypeResolver;
        }
        return $this->idScalarTypeResolver;
    }
    protected final function getCategoriesByOneofInputObjectTypeResolver() : \PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\CategoriesByOneofInputObjectTypeResolver
    {
        if ($this->categoriesByOneofInputObjectTypeResolver === null) {
            /** @var CategoriesByOneofInputObjectTypeResolver */
            $categoriesByOneofInputObjectTypeResolver = $this->instanceManager->getInstance(\PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\CategoriesByOneofInputObjectTypeResolver::class);
            $this->categoriesByOneofInputObjectTypeResolver = $categoriesByOneofInputObjectTypeResolver;
        }
        return $this->categoriesByOneofInputObjectTypeResolver;
    }
    protected final function getCategoryTaxonomyEnumStringScalarTypeResolver() : CategoryTaxonomyEnumStringScalarTypeResolver
    {
        if ($this->categoryTaxonomyEnumStringScalarTypeResolver === null) {
            /** @var CategoryTaxonomyEnumStringScalarTypeResolver */
            $categoryTaxonomyEnumStringScalarTypeResolver = $this->instanceManager->getInstance(CategoryTaxonomyEnumStringScalarTypeResolver::class);
            $this->categoryTaxonomyEnumStringScalarTypeResolver = $categoryTaxonomyEnumStringScalarTypeResolver;
        }
        return $this->categoryTaxonomyEnumStringScalarTypeResolver;
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to set categories on a custom post', 'comment-mutations');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge($this->addTaxonomyInputField() ? [MutationInputProperties::TAXONOMY => $this->getCategoryTaxonomyEnumStringScalarTypeResolver()] : [], $this->addCustomPostInputField() ? [MutationInputProperties::CUSTOMPOST_ID => $this->getIDScalarTypeResolver()] : [], [MutationInputProperties::CATEGORIES_BY => $this->getCategoriesByOneofInputObjectTypeResolver(), MutationInputProperties::APPEND => $this->getBooleanScalarTypeResolver()]);
    }
    protected abstract function addTaxonomyInputField() : bool;
    protected abstract function addCustomPostInputField() : bool;
    protected abstract function getEntityName() : string;
    protected abstract function getCategoryTypeResolver() : CategoryObjectTypeResolverInterface;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
            case MutationInputProperties::TAXONOMY:
                return $this->__('The category taxonomy', 'custompost-tag-mutations');
            case MutationInputProperties::CUSTOMPOST_ID:
                return \sprintf($this->__('The ID of the %s', 'custompost-category-mutations'), $this->getEntityName());
            case MutationInputProperties::CATEGORIES_BY:
                return \sprintf($this->__('The categories to set, of type \'%s\'', 'custompost-category-mutations'), $this->getCategoryTypeResolver()->getMaybeNamespacedTypeName());
            case MutationInputProperties::APPEND:
                return $this->__('Append the categories to the existing ones?', 'custompost-category-mutations');
            default:
                return null;
        }
    }
    /**
     * @return mixed
     */
    public function getInputFieldDefaultValue(string $inputFieldName)
    {
        switch ($inputFieldName) {
            case MutationInputProperties::APPEND:
                return \false;
            default:
                return parent::getInputFieldDefaultValue($inputFieldName);
        }
    }
    public function getInputFieldTypeModifiers(string $inputFieldName) : int
    {
        switch ($inputFieldName) {
            case MutationInputProperties::APPEND:
                return SchemaTypeModifiers::NON_NULLABLE;
            case MutationInputProperties::CUSTOMPOST_ID:
            case MutationInputProperties::CATEGORIES_BY:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getInputFieldTypeModifiers($inputFieldName);
        }
    }
}
