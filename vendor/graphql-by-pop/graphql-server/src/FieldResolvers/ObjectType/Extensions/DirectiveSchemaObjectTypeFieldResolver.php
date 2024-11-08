<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType\Extensions;

use GraphQLByPoP\GraphQLServer\ObjectModels\Directive;
use GraphQLByPoP\GraphQLServer\TypeResolvers\EnumType\DirectiveKindEnumTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\DirectiveObjectTypeResolver;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Registries\FieldDirectiveResolverRegistryInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class DirectiveSchemaObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\EnumType\DirectiveKindEnumTypeResolver|null
     */
    private $directiveKindEnumTypeResolver;
    /**
     * @var \PoP\ComponentModel\Registries\FieldDirectiveResolverRegistryInterface|null
     */
    private $fieldDirectiveResolverRegistry;
    protected final function getDirectiveKindEnumTypeResolver() : DirectiveKindEnumTypeResolver
    {
        if ($this->directiveKindEnumTypeResolver === null) {
            /** @var DirectiveKindEnumTypeResolver */
            $directiveKindEnumTypeResolver = $this->instanceManager->getInstance(DirectiveKindEnumTypeResolver::class);
            $this->directiveKindEnumTypeResolver = $directiveKindEnumTypeResolver;
        }
        return $this->directiveKindEnumTypeResolver;
    }
    protected final function getFieldDirectiveResolverRegistry() : FieldDirectiveResolverRegistryInterface
    {
        if ($this->fieldDirectiveResolverRegistry === null) {
            /** @var FieldDirectiveResolverRegistryInterface */
            $fieldDirectiveResolverRegistry = $this->instanceManager->getInstance(FieldDirectiveResolverRegistryInterface::class);
            $this->fieldDirectiveResolverRegistry = $fieldDirectiveResolverRegistry;
        }
        return $this->fieldDirectiveResolverRegistry;
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
        return ['kind'];
    }
    public function skipExposingFieldInSchema(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : bool
    {
        switch ($fieldName) {
            case 'kind':
                return \true;
            default:
                return parent::skipExposingFieldInSchema($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'kind':
                return SchemaTypeModifiers::NON_NULLABLE;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'kind':
                return $this->__('The directive type (custom property)', 'graphql-server');
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
            case 'kind':
                return $directive->getKind();
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
            case 'kind':
                return $this->getDirectiveKindEnumTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
