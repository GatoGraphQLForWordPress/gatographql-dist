<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\FieldResolvers\ObjectType\Extensions;

use GraphQLByPoP\GraphQLServer\Module;
use GraphQLByPoP\GraphQLServer\ModuleConfiguration;
use GraphQLByPoP\GraphQLServer\ObjectModels\Field;
use GraphQLByPoP\GraphQLServer\ObjectModels\ObjectType;
use GraphQLByPoP\GraphQLServer\ObjectModels\Schema;
use GraphQLByPoP\GraphQLServer\Schema\GraphQLSchemaDefinitionServiceInterface;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\FieldObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\SchemaObjectTypeResolver;
use PoP\ComponentModel\App;
use PoP\ComponentModel\Feedback\ObjectTypeFieldResolutionFeedbackStore;
use PoP\ComponentModel\FieldResolvers\ObjectType\AbstractObjectTypeFieldResolver;
use PoP\ComponentModel\QueryResolution\FieldDataAccessorInterface;
use PoP\ComponentModel\Schema\SchemaTypeModifiers;
use PoP\ComponentModel\TypeResolvers\ConcreteTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\InputTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver;
use PoP\GraphQLParser\Spec\Parser\Ast\FieldInterface;
/** @internal */
class SchemaObjectTypeFieldResolver extends AbstractObjectTypeFieldResolver
{
    /**
     * @var \PoP\ComponentModel\TypeResolvers\ScalarType\BooleanScalarTypeResolver|null
     */
    private $booleanScalarTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\FieldObjectTypeResolver|null
     */
    private $fieldObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\Schema\GraphQLSchemaDefinitionServiceInterface|null
     */
    private $graphQLSchemaDefinitionService;
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
    public final function setGraphQLSchemaDefinitionService(GraphQLSchemaDefinitionServiceInterface $graphQLSchemaDefinitionService) : void
    {
        $this->graphQLSchemaDefinitionService = $graphQLSchemaDefinitionService;
    }
    protected final function getGraphQLSchemaDefinitionService() : GraphQLSchemaDefinitionServiceInterface
    {
        if ($this->graphQLSchemaDefinitionService === null) {
            /** @var GraphQLSchemaDefinitionServiceInterface */
            $graphQLSchemaDefinitionService = $this->instanceManager->getInstance(GraphQLSchemaDefinitionServiceInterface::class);
            $this->graphQLSchemaDefinitionService = $graphQLSchemaDefinitionService;
        }
        return $this->graphQLSchemaDefinitionService;
    }
    /**
     * @return array<class-string<ObjectTypeResolverInterface>>
     */
    public function getObjectTypeResolverClassesToAttachTo() : array
    {
        return [SchemaObjectTypeResolver::class];
    }
    /**
     * @return string[]
     */
    public function getFieldNamesToResolve() : array
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return \array_merge([], $moduleConfiguration->exposeGlobalFieldsInGraphQLSchema() ? ['globalFields'] : []);
    }
    public function getFieldTypeModifiers(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : int
    {
        switch ($fieldName) {
            case 'globalFields':
                return SchemaTypeModifiers::NON_NULLABLE | SchemaTypeModifiers::IS_ARRAY | SchemaTypeModifiers::IS_NON_NULLABLE_ITEMS_IN_ARRAY;
            default:
                return parent::getFieldTypeModifiers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ?string
    {
        switch ($fieldName) {
            case 'globalFields':
                return $this->__('[Custom introspection field] All global fields (i.e. fields which are added to all types in the schema)', 'graphql-server');
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
            case 'globalFields':
                return ['includeDeprecated' => $this->getBooleanScalarTypeResolver()];
            default:
                return parent::getFieldArgNameTypeResolvers($objectTypeResolver, $fieldName);
        }
    }
    public function getFieldArgDescription(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName, string $fieldArgName) : ?string
    {
        switch ([$fieldName => $fieldArgName]) {
            case ['globalFields' => 'includeDeprecated']:
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
        /** @var Schema */
        $schema = $object;
        switch ($fieldDataAccessor->getFieldName()) {
            case 'globalFields':
                /**
                 * Get the QueryRoot type from the schema,
                 * and obtain the global fields from it.
                 *
                 * Likewise, attach the "global mutations"
                 * from the MutationRoot type.
                 *
                 * Get it from these types, because by default env var
                 * `EXPOSE_GLOBAL_FIELDS_IN_ROOT_TYPE_ONLY_IN_GRAPHQL_SCHEMA`
                 * is enabled.
                 */
                $graphQLSchemaDefinitionService = $this->getGraphQLSchemaDefinitionService();
                $queryRootNamespacedTypeName = $graphQLSchemaDefinitionService->getSchemaQueryRootObjectTypeResolver()->getNamespacedTypeName();
                /** @var ObjectType */
                $queryRootType = $schema->getType($queryRootNamespacedTypeName);
                $queryRootTypeFields = $queryRootType->getFields($fieldDataAccessor->getValue('includeDeprecated') ?? \false, \true);
                $queryAndMutationRootTypeFields = $queryRootTypeFields;
                $schemaMutationRootObjectTypeResolver = $graphQLSchemaDefinitionService->getSchemaMutationRootObjectTypeResolver();
                if ($schemaMutationRootObjectTypeResolver !== null) {
                    $mutationRootNamespacedTypeName = $schemaMutationRootObjectTypeResolver->getNamespacedTypeName();
                    /** @var ObjectType */
                    $mutationRootType = $schema->getType($mutationRootNamespacedTypeName);
                    $mutationRootTypeFields = $mutationRootType->getFields($fieldDataAccessor->getValue('includeDeprecated') ?? \false, \true);
                    $queryAndMutationRootTypeFields = \array_merge($queryAndMutationRootTypeFields, $mutationRootTypeFields);
                }
                $globalFields = \array_filter($queryAndMutationRootTypeFields, function (Field $field) {
                    return $field->getExtensions()->isGlobal();
                });
                // Global fields are added to both QueryRoot and MutationRoot, so make unique!
                return \array_values(\array_unique(\array_map(function (Field $field) {
                    return $field->getID();
                }, $globalFields)));
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
    public function getFieldTypeResolver(ObjectTypeResolverInterface $objectTypeResolver, string $fieldName) : ConcreteTypeResolverInterface
    {
        switch ($fieldName) {
            case 'globalFields':
                return $this->getFieldObjectTypeResolver();
            default:
                return parent::getFieldTypeResolver($objectTypeResolver, $fieldName);
        }
    }
}
