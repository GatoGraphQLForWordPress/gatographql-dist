<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\EnumValue;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\EnumValueExtensionsObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\EnumValueObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
class EnumValueObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\StringScalarTypeResolver|null
     */
    private $stringScalarTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\EnumValueExtensionsObjectTypeResolver|null
     */
    private $enumValueExtensionsObjectTypeResolver;
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
    public final function setEnumValueExtensionsObjectTypeResolver(EnumValueExtensionsObjectTypeResolver $enumValueExtensionsObjectTypeResolver) : void
    {
        $this->enumValueExtensionsObjectTypeResolver = $enumValueExtensionsObjectTypeResolver;
    }
    protected final function getEnumValueExtensionsObjectTypeResolver() : EnumValueExtensionsObjectTypeResolver
    {
        if ($this->enumValueExtensionsObjectTypeResolver === null) {
            /** @var EnumValueExtensionsObjectTypeResolver */
            $enumValueExtensionsObjectTypeResolver = $this->instanceManager->getInstance(EnumValueExtensionsObjectTypeResolver::class);
            $this->enumValueExtensionsObjectTypeResolver = $enumValueExtensionsObjectTypeResolver;
        }
        return $this->enumValueExtensionsObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [EnumValueObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['name', 'description', 'isDeprecated', 'deprecationReason', 'extensions'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'name':
                return $this->getStringScalarTypeResolver();
            case 'description':
                return $this->getStringScalarTypeResolver();
            case 'isDeprecated':
                return $this->getBooleanScalarTypeResolver();
            case 'deprecationReason':
                return $this->getStringScalarTypeResolver();
            case 'extensions':
                return $this->getEnumValueExtensionsObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'name':
            case 'isDeprecated':
            case 'extensions':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'name':
                return $this->__('Enum value\'s name as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLACvBBCyBH6rd)', 'graphql-server');
            case 'description':
                return $this->__('Enum value\'s description as defined by the GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLACyBIC1BHnjL)', 'graphql-server');
            case 'isDeprecated':
                return $this->__('Is the enum value deprecated?', 'graphql-server');
            case 'deprecationReason':
                return $this->__('Why was the enum value deprecated?', 'graphql-server');
            case 'extensions':
                return $this->__('Extensions (custom metadata) added to the enum value (see: https://github.com/graphql/graphql-spec/issues/300#issuecomment-504734306 and below comments, and https://github.com/graphql/graphql-js/issues/1527)', 'graphql-server');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        /** @var EnumValue */
        $enumValue = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'name':
                return $enumValue->getName();
            case 'description':
                return $enumValue->getDescription();
            case 'isDeprecated':
                return $enumValue->isDeprecated();
            case 'deprecationReason':
                return $enumValue->getDeprecatedReason();
            case 'extensions':
                return $enumValue->getExtensions()->getID();
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
