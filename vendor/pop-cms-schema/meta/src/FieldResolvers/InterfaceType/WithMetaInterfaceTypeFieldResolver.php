<?php

declare (strict_types=1);
namespace PoPCMSSchema\Meta\FieldResolvers\InterfaceType;

use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\InterfaceType\AbstractInterfaceTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\AnyBuiltInScalarScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\Meta\TypeResolvers\InterfaceType\WithMetaInterfaceTypeResolver;
class WithMetaInterfaceTypeFieldResolver extends AbstractInterfaceTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\AnyBuiltInScalarScalarTypeResolver|null
     */
    private $anyBuiltInScalarScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    public final function setAnyBuiltInScalarScalarTypeResolver(AnyBuiltInScalarScalarTypeResolver $anyBuiltInScalarScalarTypeResolver) : void
    {
        $this->anyBuiltInScalarScalarTypeResolver = $anyBuiltInScalarScalarTypeResolver;
    }
    protected final function getAnyBuiltInScalarScalarTypeResolver() : AnyBuiltInScalarScalarTypeResolver
    {
        if ($this->anyBuiltInScalarScalarTypeResolver === null) {
            /** @var AnyBuiltInScalarScalarTypeResolver */
            $anyBuiltInScalarScalarTypeResolver = $this->instanceManager->getInstance(AnyBuiltInScalarScalarTypeResolver::class);
            $this->anyBuiltInScalarScalarTypeResolver = $anyBuiltInScalarScalarTypeResolver;
        }
        return $this->anyBuiltInScalarScalarTypeResolver;
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
     * @return array<class-string<InterfaceTypeResolverInterface>>
     */
    public function getInterfaceTypeResolverClassesToAttachTo() : array
    {
        return [WithMetaInterfaceTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToImplement() : array
    {
        return ['metaValue', 'metaValues'];
    }
    public function getFieldTypeResolver(string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'metaValue':
                return $this->getStringScalarTypeResolver();
            case 'metaValues':
                return $this->getAnyBuiltInScalarScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($fieldName);
        }
    }
    public function getFieldTypeModifiers(string $fieldName) : int
    {
        switch ($fieldName) {
            case 'metaValues':
                return SchemaTypeModifiers::IS_ARRAY;
            default:
                return parent::getFieldTypeModifiers($fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(string $fieldName) : array
    {
        switch ($fieldName) {
            case 'metaValue':
            case 'metaValues':
                return ['key' => $this->getStringScalarTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($fieldName);
        }
    }
    public function getFieldArgDescription(string $fieldName, string $fieldArgName) : ?string
    {
        switch ($fieldArgName) {
            case 'key':
                return $this->__('The meta key', 'meta');
            default:
                return parent::getFieldArgDescription($fieldName, $fieldArgName);
        }
    }
    public function getFieldArgTypeModifiers(string $fieldName, string $fieldArgName) : int
    {
        switch ($fieldArgName) {
            case 'key':
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($fieldName, $fieldArgName);
        }
    }
    public function getFieldDescription(string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'metaValue':
                return $this->__('Single meta value. If the key is not allowed, it returns an error; if the key is non-existent, or the value is empty, it returns `null`; otherwise, it returns the meta value.', 'custompostmeta');
            case 'metaValues':
                return $this->__('List of meta values. If the key is not allowed, it returns an error; if the key is non-existent, or the value is empty, it returns `null`; otherwise, it returns the meta value.', 'custompostmeta');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
}
