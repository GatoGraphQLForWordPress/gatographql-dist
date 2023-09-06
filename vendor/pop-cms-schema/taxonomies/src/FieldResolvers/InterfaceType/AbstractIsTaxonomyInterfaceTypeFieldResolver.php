<?php

declare (strict_types=1);
namespace PoPCMSSchema\Taxonomies\FieldResolvers\InterfaceType;

use PoP\ComponentModel\FieldResolvers\InterfaceType\AbstractQueryableSchemaInterfaceTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
abstract class AbstractIsTaxonomyInterfaceTypeFieldResolver extends AbstractQueryableSchemaInterfaceTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IntScalarTypeResolver|null
     */
    private $intScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    public final function setIntScalarTypeResolver(IntScalarTypeResolver $intScalarTypeResolver) : void
    {
        $this->intScalarTypeResolver = $intScalarTypeResolver;
    }
    protected final function getIntScalarTypeResolver() : IntScalarTypeResolver
    {
        if ($this->intScalarTypeResolver === null) {
            /** @var IntScalarTypeResolver */
            $intScalarTypeResolver = $this->instanceManager->getInstance(IntScalarTypeResolver::class);
            $this->intScalarTypeResolver = $intScalarTypeResolver;
        }
        return $this->intScalarTypeResolver;
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
    /**
     * @return string[]
     */
    public function getFieldNamesToImplement() : array
    {
        return ['name', 'count', 'description'];
    }
    public function getFieldTypeResolver(string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'name':
                return $this->getStringScalarTypeResolver();
            case 'description':
                return $this->getStringScalarTypeResolver();
            case 'count':
                return $this->getIntScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($fieldName);
        }
    }
    public function getFieldTypeModifiers(string $fieldName) : int
    {
        switch ($fieldName) {
            case 'name':
            case 'count':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($fieldName);
        }
    }
    public function getFieldDescription(string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'name':
                return $this->__('Taxonomy', 'taxonomies');
            case 'description':
                return $this->__('Taxonomy description', 'taxonomies');
            case 'count':
                return $this->__('Number of custom posts containing this taxonomy', 'taxonomies');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
}
