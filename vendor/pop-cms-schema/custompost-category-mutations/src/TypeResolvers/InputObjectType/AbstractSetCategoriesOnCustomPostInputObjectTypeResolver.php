<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType;

use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputObjectType\AbstractInputObjectTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
use PoPCMSSchema\Categories\TypeResolvers\ObjectType\CategoryObjectTypeResolverInterface;
use PoPCMSSchema\CustomPostCategoryMutations\Constants\MutationInputProperties;
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
    public final function setIDScalarTypeResolver(IDScalarTypeResolver $idScalarTypeResolver) : void
    {
        $this->idScalarTypeResolver = $idScalarTypeResolver;
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
    public final function setCategoriesByOneofInputObjectTypeResolver(\PoPCMSSchema\CustomPostCategoryMutations\TypeResolvers\InputObjectType\CategoriesByOneofInputObjectTypeResolver $categoriesByOneofInputObjectTypeResolver) : void
    {
        $this->categoriesByOneofInputObjectTypeResolver = $categoriesByOneofInputObjectTypeResolver;
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
    public function getTypeDescription() : ?string
    {
        return $this->__('Input to set categories on a custom post', 'comment-mutations');
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getInputFieldNameTypeResolvers() : array
    {
        return \array_merge($this->addCustomPostInputField() ? [MutationInputProperties::CUSTOMPOST_ID => $this->getIDScalarTypeResolver()] : [], [MutationInputProperties::CATEGORIES_BY => $this->getCategoriesByOneofInputObjectTypeResolver(), MutationInputProperties::APPEND => $this->getBooleanScalarTypeResolver()]);
    }
    protected abstract function addCustomPostInputField() : bool;
    protected abstract function getEntityName() : string;
    protected abstract function getCategoryTypeResolver() : CategoryObjectTypeResolverInterface;
    public function getInputFieldDescription(string $inputFieldName) : ?string
    {
        switch ($inputFieldName) {
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
