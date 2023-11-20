<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\FieldResolvers\InterfaceType;

use PoPSchema\SchemaCommons\TypeResolvers\InterfaceType\ErrorPayloadInterfaceTypeResolver;
use PoP\ComponentModel\FieldResolvers\InterfaceType\AbstractInterfaceTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
/** @internal */
class ErrorPayloadInterfaceTypeFieldResolver extends AbstractInterfaceTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
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
        return [ErrorPayloadInterfaceTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToImplement() : array
    {
        return ['message'];
    }
    public function getFieldTypeResolver(string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'message':
                return $this->getStringScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($fieldName);
        }
    }
    public function getFieldTypeModifiers(string $fieldName) : int
    {
        switch ($fieldName) {
            case 'message':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($fieldName);
        }
    }
    public function getFieldDescription(string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'message':
                return $this->__('Error message', 'schema-commons');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
}
