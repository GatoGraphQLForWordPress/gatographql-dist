<?php

declare (strict_types=1);
namespace PoPCMSSchema\QueriedObject\FieldResolvers\InterfaceType;

use PoP\ComponentModel\TypeResolvers\InterfaceType\InterfaceTypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\InterfaceType\AbstractInterfaceTypeFieldResolver;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoPCMSSchema\QueriedObject\TypeResolvers\InterfaceType\QueryableInterfaceTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLAbsolutePathScalarTypeResolver;
use PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver;
class QueryableInterfaceTypeFieldResolver extends AbstractInterfaceTypeFieldResolver
{
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLScalarTypeResolver|null
     */
    private $urlScalarTypeResolver;
    /**
     * @var \PoPSchema\SchemaCommons\TypeResolvers\ScalarType\URLAbsolutePathScalarTypeResolver|null
     */
    private $urlAbsolutePathScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    public final function setURLScalarTypeResolver(URLScalarTypeResolver $urlScalarTypeResolver) : void
    {
        $this->urlScalarTypeResolver = $urlScalarTypeResolver;
    }
    protected final function getURLScalarTypeResolver() : URLScalarTypeResolver
    {
        if ($this->urlScalarTypeResolver === null) {
            /** @var URLScalarTypeResolver */
            $urlScalarTypeResolver = $this->instanceManager->getInstance(URLScalarTypeResolver::class);
            $this->urlScalarTypeResolver = $urlScalarTypeResolver;
        }
        return $this->urlScalarTypeResolver;
    }
    public final function setURLAbsolutePathScalarTypeResolver(URLAbsolutePathScalarTypeResolver $urlAbsolutePathScalarTypeResolver) : void
    {
        $this->urlAbsolutePathScalarTypeResolver = $urlAbsolutePathScalarTypeResolver;
    }
    protected final function getURLAbsolutePathScalarTypeResolver() : URLAbsolutePathScalarTypeResolver
    {
        if ($this->urlAbsolutePathScalarTypeResolver === null) {
            /** @var URLAbsolutePathScalarTypeResolver */
            $urlAbsolutePathScalarTypeResolver = $this->instanceManager->getInstance(URLAbsolutePathScalarTypeResolver::class);
            $this->urlAbsolutePathScalarTypeResolver = $urlAbsolutePathScalarTypeResolver;
        }
        return $this->urlAbsolutePathScalarTypeResolver;
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
        return [QueryableInterfaceTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToImplement() : array
    {
        return ['url', 'urlPath', 'slug'];
    }
    public function getFieldTypeResolver(string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'url':
                return $this->getURLScalarTypeResolver();
            case 'urlPath':
                return $this->getURLAbsolutePathScalarTypeResolver();
            case 'slug':
                return $this->getStringScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($fieldName);
        }
    }
    public function getFieldTypeModifiers(string $fieldName) : int
    {
        switch ($fieldName) {
            case 'url':
            case 'urlPath':
            case 'slug':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($fieldName);
        }
    }
    public function getFieldDescription(string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'url':
                return $this->__('URL to query the object', 'queriedobject');
            case 'urlPath':
                return $this->__('URL path to query the object', 'queriedobject');
            case 'slug':
                return $this->__('URL\'s slug', 'queriedobject');
            default:
                return parent::getFieldDescription($fieldName);
        }
    }
}
