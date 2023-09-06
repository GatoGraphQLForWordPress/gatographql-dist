<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\EnumType;
use GraphQLByPoP\GraphQLServer\ObjectModels\HasFieldsTypeInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\HasInterfacesTypeInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\HasPossibleTypesTypeInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\InputObjectType;
use GraphQLByPoP\GraphQLServer\ObjectModels\NamedTypeInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\ScalarType;
use GraphQLByPoP\GraphQLServer\ObjectModels\TypeInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\TypeKinds;
use GraphQLByPoP\GraphQLServer\ObjectModels\WrappingTypeInterface;
use GraphQLByPoP\GraphQLServer\TypeResolvers\EnumType\TypeKindEnumTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\EnumValueObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\FieldObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\InputValueObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\NamedTypeExtensionsObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\TypeObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
class TypeObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\NamedTypeExtensionsObjectTypeResolver|null
     */
    private $namedTypeExtensionsObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\FieldObjectTypeResolver|null
     */
    private $fieldObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\TypeObjectTypeResolver|null
     */
    private $typeObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\EnumValueObjectTypeResolver|null
     */
    private $enumValueObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\InputValueObjectTypeResolver|null
     */
    private $inputValueObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\EnumType\TypeKindEnumTypeResolver|null
     */
    private $typeKindEnumTypeResolver;
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
    public final function setNamedTypeExtensionsObjectTypeResolver(NamedTypeExtensionsObjectTypeResolver $namedTypeExtensionsObjectTypeResolver) : void
    {
        $this->namedTypeExtensionsObjectTypeResolver = $namedTypeExtensionsObjectTypeResolver;
    }
    protected final function getNamedTypeExtensionsObjectTypeResolver() : NamedTypeExtensionsObjectTypeResolver
    {
        if ($this->namedTypeExtensionsObjectTypeResolver === null) {
            /** @var NamedTypeExtensionsObjectTypeResolver */
            $namedTypeExtensionsObjectTypeResolver = $this->instanceManager->getInstance(NamedTypeExtensionsObjectTypeResolver::class);
            $this->namedTypeExtensionsObjectTypeResolver = $namedTypeExtensionsObjectTypeResolver;
        }
        return $this->namedTypeExtensionsObjectTypeResolver;
    }
    public final function setFieldObjectTypeResolver(FieldObjectTypeResolver $fieldObjectTypeResolver) : void
    {
        $this->fieldObjectTypeResolver = $fieldObjectTypeResolver;
    }
    protected final function getFieldObjectTypeResolver() : FieldObjectTypeResolver
    {
        if ($this->fieldObjectTypeResolver === null) {
            /** @var FieldObjectTypeResolver */
            $fieldObjectTypeResolver = $this->instanceManager->getInstance(FieldObjectTypeResolver::class);
            $this->fieldObjectTypeResolver = $fieldObjectTypeResolver;
        }
        return $this->fieldObjectTypeResolver;
    }
    public final function setTypeObjectTypeResolver(TypeObjectTypeResolver $typeObjectTypeResolver) : void
    {
        $this->typeObjectTypeResolver = $typeObjectTypeResolver;
    }
    protected final function getTypeObjectTypeResolver() : TypeObjectTypeResolver
    {
        if ($this->typeObjectTypeResolver === null) {
            /** @var TypeObjectTypeResolver */
            $typeObjectTypeResolver = $this->instanceManager->getInstance(TypeObjectTypeResolver::class);
            $this->typeObjectTypeResolver = $typeObjectTypeResolver;
        }
        return $this->typeObjectTypeResolver;
    }
    public final function setEnumValueObjectTypeResolver(EnumValueObjectTypeResolver $enumValueObjectTypeResolver) : void
    {
        $this->enumValueObjectTypeResolver = $enumValueObjectTypeResolver;
    }
    protected final function getEnumValueObjectTypeResolver() : EnumValueObjectTypeResolver
    {
        if ($this->enumValueObjectTypeResolver === null) {
            /** @var EnumValueObjectTypeResolver */
            $enumValueObjectTypeResolver = $this->instanceManager->getInstance(EnumValueObjectTypeResolver::class);
            $this->enumValueObjectTypeResolver = $enumValueObjectTypeResolver;
        }
        return $this->enumValueObjectTypeResolver;
    }
    public final function setInputValueObjectTypeResolver(InputValueObjectTypeResolver $inputValueObjectTypeResolver) : void
    {
        $this->inputValueObjectTypeResolver = $inputValueObjectTypeResolver;
    }
    protected final function getInputValueObjectTypeResolver() : InputValueObjectTypeResolver
    {
        if ($this->inputValueObjectTypeResolver === null) {
            /** @var InputValueObjectTypeResolver */
            $inputValueObjectTypeResolver = $this->instanceManager->getInstance(InputValueObjectTypeResolver::class);
            $this->inputValueObjectTypeResolver = $inputValueObjectTypeResolver;
        }
        return $this->inputValueObjectTypeResolver;
    }
    public final function setTypeKindEnumTypeResolver(TypeKindEnumTypeResolver $typeKindEnumTypeResolver) : void
    {
        $this->typeKindEnumTypeResolver = $typeKindEnumTypeResolver;
    }
    protected final function getTypeKindEnumTypeResolver() : TypeKindEnumTypeResolver
    {
        if ($this->typeKindEnumTypeResolver === null) {
            /** @var TypeKindEnumTypeResolver */
            $typeKindEnumTypeResolver = $this->instanceManager->getInstance(TypeKindEnumTypeResolver::class);
            $this->typeKindEnumTypeResolver = $typeKindEnumTypeResolver;
        }
        return $this->typeKindEnumTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [TypeObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['kind', 'name', 'description', 'fields', 'interfaces', 'possibleTypes', 'enumValues', 'inputFields', 'ofType', 'specifiedByURL', 'extensions'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'name':
            case 'description':
            case 'specifiedByURL':
                return $this->getStringScalarTypeResolver();
            case 'extensions':
                return $this->getNamedTypeExtensionsObjectTypeResolver();
            case 'fields':
                return $this->getFieldObjectTypeResolver();
            case 'interfaces':
            case 'possibleTypes':
            case 'ofType':
                return $this->getTypeObjectTypeResolver();
            case 'enumValues':
                return $this->getEnumValueObjectTypeResolver();
            case 'inputFields':
                return $this->getInputValueObjectTypeResolver();
            case 'kind':
                return $this->getTypeKindEnumTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'kind':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'fields':
            case 'interfaces':
            case 'possibleTypes':
            case 'enumValues':
            case 'inputFields':
                return SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'kind':
                return $this->__('Type\'s kind as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLACqBBCvBAtrC)', 'graphql-server');
            case 'name':
                return $this->__('Type\'s name as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLACvBBCyBH6rd)', 'graphql-server');
            case 'description':
                return $this->__('Type\'s description as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLACyBIC1BHnjL)', 'graphql-server');
            case 'fields':
                return $this->__('Type\'s fields (available for Object and Interface types only) as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLAC3BBCnCA8pY)', 'graphql-server');
            case 'interfaces':
                return $this->__('Type\'s interfaces (available for Object type only) as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLACpCBCxCA7tB)', 'graphql-server');
            case 'possibleTypes':
                return $this->__('Type\'s possible types (available for Interface and Union types only) as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLACzCBC7CA0vN)', 'graphql-server');
            case 'enumValues':
                return $this->__('Type\'s enum values (available for Enum type only) as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLAC9CDD_CAA2lB)', 'graphql-server');
            case 'inputFields':
                return $this->__('Type\'s input Fields (available for InputObject type only) as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-HAJbLAuDABCBIu9N)', 'graphql-server');
            case 'ofType':
                return $this->__('The type of the nested type (available for NonNull and List types only) as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-HAJbLA4DABCBIu9N)', 'graphql-server');
            case 'specifiedByURL':
                return $this->__('A scalar specification URL (a String (in the form of a URL) for custom scalars, otherwise must be null) as defined by the GraphQL spec (https://spec.graphql.org/draft/#sel-IAJXNFA0EABABL9N)', 'graphql-server');
            case 'extensions':
                return $this->__('Extensions (custom metadata) added to the GraphQL type (for all \'named\' types: Object, Interface, Union, Scalar, Enum and InputObject) (see: https://github.com/graphql/graphql-spec/issues/300#issuecomment-504734306 and below comments, and https://github.com/graphql/graphql-js/issues/1527)', 'graphql-server');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'fields':
            case 'enumValues':
                return ['includeDeprecated' => $this->getBooleanScalarTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        switch ($fieldArgName) {
            case 'includeDeprecated':
                return $this->__('Include deprecated fields?', 'graphql-server');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function getFieldArgDefaultValue(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName)
    {
        switch ($fieldArgName) {
            case 'includeDeprecated':
                return \false;
            default:
                return parent::getFieldArgDefaultValue($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        /** @var TypeInterface */
        $type = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'kind':
                return $type->getKind();
            case 'name':
                return $type->getName();
            case 'description':
                return $type->getDescription();
            case 'fields':
                // From GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLAC1BJC3BAn6e):
                // "should be non-null for OBJECT and INTERFACE only, must be null for the others"
                if ($type instanceof HasFieldsTypeInterface) {
                    /**
                     * Only include the global fields for Objects!
                     * (i.e. do not for Interfaces)
                     */
                    $includeGlobal = $type->getKind() === TypeKinds::OBJECT;
                    return $type->getFieldIDs($fieldDataAccessor->getValue('includeDeprecated') ?? \false, $includeGlobal);
                }
                return null;
            case 'interfaces':
                // From GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLACnCCCpCA4yV):
                // "should be non-null for OBJECT only, must be null for the others"
                if ($type instanceof HasInterfacesTypeInterface) {
                    return $type->getInterfaceIDs();
                }
                return null;
            case 'possibleTypes':
                // From GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLACxCCCzCA_9R):
                // "should be non-null for INTERFACE and UNION only, always null for the others"
                if ($type instanceof HasPossibleTypesTypeInterface) {
                    return $type->getPossibleTypeIDs();
                }
                return null;
            case 'enumValues':
                // From GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLAC7CCC9CA2nT):
                // "should be non-null for ENUM only, must be null for the others"
                if ($type instanceof EnumType) {
                    return $type->getEnumValueIDs($fieldDataAccessor->getValue('includeDeprecated') ?? \false);
                }
                return null;
            case 'inputFields':
                // From GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-HAJbLAuDABCBIu9N):
                // "should be non-null for INPUT_OBJECT only, must be null for the others"
                if ($type instanceof InputObjectType) {
                    return $type->getInputFieldIDs();
                }
                return null;
            case 'ofType':
                // From GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-HAJbLA4DABCBIu9N):
                // "should be non-null for NON_NULL and LIST only, must be null for the others"
                if ($type instanceof WrappingTypeInterface) {
                    return $type->getWrappedTypeID();
                }
                return null;
            case 'specifiedByURL':
                // From GraphQL spec (https://spec.graphql.org/draft/#sel-GAJXNFACzEDD1EAA_pc):
                // "may be non-null for custom SCALAR, otherwise null"
                if ($type instanceof ScalarType) {
                    return $type->getSpecifiedByURL();
                }
                return null;
            case 'extensions':
                // Custom development: this field is not in GraphQL spec yet!
                // @see https://github.com/graphql/graphql-spec/issues/300
                // Implementation based on the one by GraphQL Java
                // @see https://github.com/graphql-java/graphql-java/pull/2221
                // Non-null for named types, null for wrapping types (Non-Null and List)
                if ($type instanceof NamedTypeInterface) {
                    return $type->getExtensions()->getID();
                }
                return null;
        }
        return parent::resolveValue($objectTypeResolver, $object, $fieldDataAccessor, $objectTypeFieldResolutionFeedbackStore);
    }
    /**
     * Since the return type is known for all the fields in this
     * FieldResolver, there's no need to validate them
     */
    public function validateResolvedFieldType(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : bool
    {
        return \false;
    }
}
