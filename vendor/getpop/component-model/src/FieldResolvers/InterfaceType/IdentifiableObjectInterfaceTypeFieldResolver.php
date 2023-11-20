<?php

declare (strict_types=1);
namespace PoP\ComponentModel\FieldResolvers\InterfaceType;

use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InterfaceType\IdentifiableObjectInterfaceTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver;
/** @internal */
class IdentifiableObjectInterfaceTypeFieldResolver extends \PoP\ComponentModel\FieldResolvers\InterfaceType\AbstractInterfaceTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\IDScalarTypeResolver|null
     */
    private $idScalarTypeResolver;
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
    /**
     * @return array<class-string<InterfaceTypeResolverInterface>>
     */
    public function getInterfaceTypeResolverClassesToAttachTo() : array
    {
        return [IdentifiableObjectInterfaceTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToImplement() : array
    {
        return ['id', 'globalID'];
    }
    public function getFieldTypeResolver(string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'id':
            case 'globalID':
                return $this->getIDScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($fieldName);
        }
    }
    public function getFieldTypeModifiers(string $fieldName) : int
    {
        switch ($fieldName) {
            case 'id':
            case 'globalID':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($fieldName);
        }
    }
    public function getFieldDescription(string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'id':
                return $this->__('The object\'s unique identifier for its type', 'component-model');
            case 'globalID':
                return $this->__('The object\'s globally unique identifier', 'component-model');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
}
