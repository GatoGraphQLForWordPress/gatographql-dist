<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType\Extensions;

use GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType\TypeObjectTypeFieldResolver as UpstreamTypeObjectTypeFieldResolver;
use GraphQLByPoP\GraphQLServer\Module;
use GraphQLByPoP\GraphQLServer\ModuleConfiguration;
use GraphQLByPoP\GraphQLServer\ObjectModels\HasFieldsTypeInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\NamedTypeInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\TypeKinds;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class TypeObjectTypeFieldResolver extends UpstreamTypeObjectTypeFieldResolver
{
    public function getPriorityToAttachToClasses() : int
    {
        // Higher priority => Process first
        return 100;
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return \array_merge(['name'], $moduleConfiguration->exposeGlobalFieldsInGraphQLSchema() ? ['fields'] : []);
    }
    /**
     * Only use this fieldResolver when parameter `namespaced` is provided. Otherwise, use the default implementation
     */
    public function resolveCanProcessField(ObjectTypeResolverInterface $objectTypeResolver, FieldInterface $field) : bool
    {
        switch ($field->getName()) {
            case 'name':
                return $field->hasArgument('namespaced');
            case 'fields':
                return $field->hasArgument('includeGlobal');
            default:
                return parent::resolveCanProcessField($objectTypeResolver, $field);
        }
    }
    /**
     * @return array<string,InputTypeResolverInterface>
     */
    public function getFieldArgNameTypeResolvers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : array
    {
        switch ($fieldName) {
            case 'name':
                return ['namespaced' => $this->getBooleanScalarTypeResolver()];
            case 'fields':
                return \array_merge(parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName), ['includeGlobal' => $this->getBooleanScalarTypeResolver()]);
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['name' => 'namespaced']:
                return $this->__('Namespace type name?', 'graphql-server');
            case ['fields' => 'includeGlobal']:
                return $this->__('Include global fields?', 'graphql-server');
            default:
                return parent::getFieldArgDescription($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    public function getFieldArgTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : int
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['name' => 'namespaced']:
                return SchemaTypeModifiers::MANDATORY;
            case ['fields' => 'includeGlobal']:
                return SchemaTypeModifiers::MANDATORY;
            default:
                return parent::getFieldArgTypeModifiers($objectTypeResolver, $fieldName, $fieldArgName);
        }
    }
    /**
     * @return mixed
     */
    public function resolveValue(ObjectTypeResolverInterface $objectTypeResolver, object $object, FieldDataAccessorInterface $fieldDataAccessor, ObjectTypeFieldResolutionFeedbackStore $objectTypeFieldResolutionFeedbackStore)
    {
        /** @var NamedTypeInterface */
        $type = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'name':
                if ($fieldDataAccessor->getValue('namespaced')) {
                    return $type->getNamespacedName();
                }
                return $type->getElementName();
            case 'fields':
                // From GraphQL spec (https://graphql.github.io/graphql-spec/draft/#sel-FAJbLAC1BJC3BAn6e):
                // "should be non-null for OBJECT and INTERFACE only, must be null for the others"
                if ($type instanceof HasFieldsTypeInterface) {
                    /**
                     * Only include the global fields for Objects!
                     * (i.e. do not for Interfaces)
                     */
                    $includeGlobal = $type->getKind() === TypeKinds::OBJECT ? $fieldDataAccessor->getValue('includeGlobal') ?? \true : \false;
                    return $type->getFieldIDs($fieldDataAccessor->getValue('includeDeprecated') ?? \false, $includeGlobal);
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
