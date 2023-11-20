<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\NamedTypeExtensions;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\NamedTypeExtensionsObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class NamedTypeExtensionsObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
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
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [NamedTypeExtensionsObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['elementName', 'namespacedName', 'possibleValues', 'isOneOf'];
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'elementName':
            case 'namespacedName':
            case 'isOneOf':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'possibleValues':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'elementName':
                return $this->__('The type\'s non-namespaced name', 'graphql-server');
            case 'namespacedName':
                return $this->__('The type\'s namespaced name', 'graphql-server');
            case 'possibleValues':
                return $this->__('Enum-like "possible values" for EnumString type resolvers, `null` otherwise', 'graphql-server');
            case 'isOneOf':
                return $this->__('`true` for OneOf Input Objects, `false` otherwise', 'graphql-server');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        /** @var NamedTypeExtensions */
        $namedTypeExtensions = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'elementName':
                return $namedTypeExtensions->getTypeElementName();
            case 'namespacedName':
                return $namedTypeExtensions->getTypeNamespacedName();
            case 'possibleValues':
                return $namedTypeExtensions->getTypePossibleValues();
            case 'isOneOf':
                return $namedTypeExtensions->getTypeIsOneOfInputObjectType();
            default:
                return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
        }
    }
    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : bool
    {
        return \false;
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'elementName':
            case 'namespacedName':
            case 'possibleValues':
                return $this->getStringScalarTypeResolver();
            case 'isOneOf':
                return $this->getBooleanScalarTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
