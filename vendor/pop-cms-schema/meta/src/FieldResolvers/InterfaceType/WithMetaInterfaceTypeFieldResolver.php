<?php

declare (strict_types=1);
namespace PoPCMSSchema\Meta\FieldResolvers\InterfaceType;

use PoPCMSSchema\Meta\TypeResolvers\InputObjectType\MetaKeysFilterInputObjectTypeResolver;
use PoPCMSSchema\Meta\TypeResolvers\InterfaceType\WithMetaInterfaceTypeResolver;
use PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType\ListValueJSONObjectScalarTypeResolver;
use PoP\ComponentModel\FieldResolvers\InterfaceType\AbstractInterfaceTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\AnyScalarScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
class WithMetaInterfaceTypeFieldResolver extends AbstractInterfaceTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\AnyScalarScalarTypeResolver|null
     */
    private $anyScalarScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoPSchema\ExtendedSchemaCommons\TypeResolvers\ScalarType\ListValueJSONObjectScalarTypeResolver|null
     */
    private $listValueJSONObjectScalarTypeResolver;
    /**
     * @var \PoPCMSSchema\Meta\TypeResolvers\InputObjectType\MetaKeysFilterInputObjectTypeResolver|null
     */
    private $metaKeysFilterInputObjectTypeResolver;
    protected final function getAnyScalarScalarTypeResolver() : AnyScalarScalarTypeResolver
    {
        if ($this->anyScalarScalarTypeResolver === null) {
            /** @var AnyScalarScalarTypeResolver */
            $anyScalarScalarTypeResolver = $this->instanceManager->getInstance(AnyScalarScalarTypeResolver::class);
            $this->anyScalarScalarTypeResolver = $anyScalarScalarTypeResolver;
        }
        return $this->anyScalarScalarTypeResolver;
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
    protected final function getListValueJSONObjectScalarTypeResolver() : ListValueJSONObjectScalarTypeResolver
    {
        if ($this->listValueJSONObjectScalarTypeResolver === null) {
            /** @var ListValueJSONObjectScalarTypeResolver */
            $listValueJSONObjectScalarTypeResolver = $this->instanceManager->getInstance(ListValueJSONObjectScalarTypeResolver::class);
            $this->listValueJSONObjectScalarTypeResolver = $listValueJSONObjectScalarTypeResolver;
        }
        return $this->listValueJSONObjectScalarTypeResolver;
    }
    protected final function getMetaKeysFilterInputObjectTypeResolver() : MetaKeysFilterInputObjectTypeResolver
    {
        if ($this->metaKeysFilterInputObjectTypeResolver === null) {
            /** @var MetaKeysFilterInputObjectTypeResolver */
            $metaKeysFilterInputObjectTypeResolver = $this->instanceManager->getInstance(MetaKeysFilterInputObjectTypeResolver::class);
            $this->metaKeysFilterInputObjectTypeResolver = $metaKeysFilterInputObjectTypeResolver;
        }
        return $this->metaKeysFilterInputObjectTypeResolver;
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
        return ['metaKeys', 'metaValue', 'metaValues', 'meta'];
    }
    public function getFieldTypeResolver(string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'metaKeys':
                return $this->getStringScalarTypeResolver();
            case 'metaValue':
            case 'metaValues':
                return $this->getAnyScalarScalarTypeResolver();
            case 'meta':
                return $this->getListValueJSONObjectScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($fieldName);
        }
    }
    public function getFieldTypeModifiers(string $fieldName) : int
    {
        switch ($fieldName) {
            case 'metaKeys':
            case 'metaValues':
                return SchemaTypeModifiers::IS_ARRAY;
            case 'meta':
                return SchemaTypeModifiers::NON_NULLABLE;
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
            case 'metaKeys':
                return ['filter' => $this->getMetaKeysFilterInputObjectTypeResolver()];
            case 'metaValue':
            case 'metaValues':
                return ['key' => $this->getStringScalarTypeResolver()];
            case 'meta':
                return ['keys' => $this->getStringScalarTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($fieldName);
        }
    }
    public function getFieldArgDescription(string $fieldName, string $fieldArgName) : ?string
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['metaKeys' => 'filter']:
                return $this->__('Input to filter meta keys', 'gatographql');
            case ['metaValue' => 'key']:
            case ['metaValues' => 'key']:
                return $this->__('The meta key', 'meta');
            case ['meta' => 'keys']:
                return $this->__('The meta keys', 'meta');
            default:
                return parent::getFieldArgDescription($fieldName, $fieldArgName);
        }
    }
    public function getFieldArgTypeModifiers(string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['metaValue' => 'key']:
            case ['metaValues' => 'key']:
                return SchemaTypeModifiers::MANDATORY;
            case ['meta' => 'keys']:
                return SchemaTypeModifiers::MANDATORY | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldArgTypeModifiers($fieldName, $fieldArgName);
        }
    }
    public function getFieldDescription(string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'metaKeys':
                return $this->__('List of allowed meta keys set on the entity.', 'custompostmeta');
            case 'metaValue':
                return $this->__('Single meta value. If the key is not allowed, it returns an error; if the key is non-existent, or the value is empty, it returns `null`; otherwise, it returns the meta value.', 'custompostmeta');
            case 'metaValues':
                return $this->__('List of meta values. If the key is not allowed, it returns an error; if the key is non-existent, or the value is empty, it returns `null`; otherwise, it returns the meta value.', 'custompostmeta');
            case 'meta':
                return $this->__('JSON object, with key the meta key, and value an array of values (a scalar value is returned as an array with 1 item).', 'custompostmeta');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
}
