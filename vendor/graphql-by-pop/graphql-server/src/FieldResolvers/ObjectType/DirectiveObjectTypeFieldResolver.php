<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\Directive;
use GraphQLByPoP\GraphQLServer\TypeResolvers\EnumType\DirectiveLocationEnumTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\DirectiveExtensionsObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\DirectiveObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\InputValueObjectTypeResolver;
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
class DirectiveObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
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
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\InputValueObjectTypeResolver|null
     */
    private $inputValueObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\EnumType\DirectiveLocationEnumTypeResolver|null
     */
    private $directiveLocationEnumTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\DirectiveExtensionsObjectTypeResolver|null
     */
    private $directiveExtensionsObjectTypeResolver;
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
    public final function setDirectiveLocationEnumTypeResolver(DirectiveLocationEnumTypeResolver $directiveLocationEnumTypeResolver) : void
    {
        $this->directiveLocationEnumTypeResolver = $directiveLocationEnumTypeResolver;
    }
    protected final function getDirectiveLocationEnumTypeResolver() : DirectiveLocationEnumTypeResolver
    {
        if ($this->directiveLocationEnumTypeResolver === null) {
            /** @var DirectiveLocationEnumTypeResolver */
            $directiveLocationEnumTypeResolver = $this->instanceManager->getInstance(DirectiveLocationEnumTypeResolver::class);
            $this->directiveLocationEnumTypeResolver = $directiveLocationEnumTypeResolver;
        }
        return $this->directiveLocationEnumTypeResolver;
    }
    public final function setDirectiveExtensionsObjectTypeResolver(DirectiveExtensionsObjectTypeResolver $directiveExtensionsObjectTypeResolver) : void
    {
        $this->directiveExtensionsObjectTypeResolver = $directiveExtensionsObjectTypeResolver;
    }
    protected final function getDirectiveExtensionsObjectTypeResolver() : DirectiveExtensionsObjectTypeResolver
    {
        if ($this->directiveExtensionsObjectTypeResolver === null) {
            /** @var DirectiveExtensionsObjectTypeResolver */
            $directiveExtensionsObjectTypeResolver = $this->instanceManager->getInstance(DirectiveExtensionsObjectTypeResolver::class);
            $this->directiveExtensionsObjectTypeResolver = $directiveExtensionsObjectTypeResolver;
        }
        return $this->directiveExtensionsObjectTypeResolver;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [DirectiveObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        return ['name', 'description', 'args', 'locations', 'isRepeatable', 'extensions'];
    }
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'name':
                return $this->getStringScalarTypeResolver();
            case 'description':
                return $this->getStringScalarTypeResolver();
            case 'isRepeatable':
                return $this->getBooleanScalarTypeResolver();
            case 'args':
                return $this->getInputValueObjectTypeResolver();
            case 'locations':
                return $this->getDirectiveLocationEnumTypeResolver();
            case 'extensions':
                return $this->getDirectiveExtensionsObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'name':
            case 'isRepeatable':
            case 'extensions':
                return SchemaTypeModifiers::NON_NULLABLE;
            case 'locations':
            case 'args':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'name':
                return $this->__('Directive\'s name', 'graphql-server');
            case 'description':
                return $this->__('Directive\'s description', 'graphql-server');
            case 'args':
                return $this->__('Directive\'s arguments', 'graphql-server');
            case 'locations':
                return $this->__('The locations where the directive may be placed', 'graphql-server');
            case 'isRepeatable':
                return $this->__('Can the directive be executed more than once in the same field?', 'graphql-server');
            case 'extensions':
                return $this->__('Extensions (custom metadata) added to the directive (see: https://github.com/graphql/graphql-spec/issues/300#issuecomment-504734306 and below comments, and https://github.com/graphql/graphql-js/issues/1527)', 'graphql-server');
            default:
                return parent::getFieldDescription($objectTypeResolver, $fieldName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        /** @var Directive */
        $directive = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'name':
                return $directive->getName();
            case 'description':
                return $directive->getDescription();
            case 'args':
                return $directive->getArgIDs();
            case 'locations':
                return $directive->getLocations();
            case 'isRepeatable':
                return $directive->isRepeatable();
            case 'extensions':
                return $directive->getExtensions()->getID();
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
