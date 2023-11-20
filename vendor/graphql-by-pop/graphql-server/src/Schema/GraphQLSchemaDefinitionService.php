<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\Schema;

use GraphQLByPoP\GraphQLServer\Module;
use GraphQLByPoP\GraphQLServer\ModuleConfiguration;
use GraphQLByPoP\GraphQLServer\ObjectModels\SchemaDefinition\RootObjectTypeSchemaDefinitionProvider;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\MutationRootObjectTypeResolver;
use GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\QueryRootObjectTypeResolver;
use PoP\ComponentModel\Module as ComponentModelModule;
use PoP\ComponentModel\ModuleConfiguration as ComponentModelModuleConfiguration;
use PoP\ComponentModel\TypeResolvers\ObjectType\ObjectTypeResolverInterface;
use PoP\Engine\TypeResolvers\ObjectType\RootObjectTypeResolver;
use PoP\Root\App;
use PoPAPI\API\ObjectModels\SchemaDefinition\RootObjectTypeSchemaDefinitionProvider as UpstreamRootObjectTypeSchemaDefinitionProvider;
use PoPAPI\API\Schema\SchemaDefinitionService;
/** @internal */
class GraphQLSchemaDefinitionService extends SchemaDefinitionService implements \GraphQLByPoP\GraphQLServer\Schema\GraphQLSchemaDefinitionServiceInterface
{
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\QueryRootObjectTypeResolver|null
     */
    private $queryRootObjectTypeResolver;
    /**
     * @var \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\MutationRootObjectTypeResolver|null
     */
    private $mutationRootObjectTypeResolver;
    public final function setQueryRootObjectTypeResolver(QueryRootObjectTypeResolver $queryRootObjectTypeResolver) : void
    {
        $this->queryRootObjectTypeResolver = $queryRootObjectTypeResolver;
    }
    protected final function getQueryRootObjectTypeResolver() : QueryRootObjectTypeResolver
    {
        if ($this->queryRootObjectTypeResolver === null) {
            /** @var QueryRootObjectTypeResolver */
            $queryRootObjectTypeResolver = $this->instanceManager->getInstance(QueryRootObjectTypeResolver::class);
            $this->queryRootObjectTypeResolver = $queryRootObjectTypeResolver;
        }
        return $this->queryRootObjectTypeResolver;
    }
    public final function setMutationRootObjectTypeResolver(MutationRootObjectTypeResolver $mutationRootObjectTypeResolver) : void
    {
        $this->mutationRootObjectTypeResolver = $mutationRootObjectTypeResolver;
    }
    protected final function getMutationRootObjectTypeResolver() : MutationRootObjectTypeResolver
    {
        if ($this->mutationRootObjectTypeResolver === null) {
            /** @var MutationRootObjectTypeResolver */
            $mutationRootObjectTypeResolver = $this->instanceManager->getInstance(MutationRootObjectTypeResolver::class);
            $this->mutationRootObjectTypeResolver = $mutationRootObjectTypeResolver;
        }
        return $this->mutationRootObjectTypeResolver;
    }
    /**
     * If nested mutations are enabled, use "Root".
     * Otherwise, use "Query"
     */
    public function getSchemaQueryRootObjectTypeResolver() : ObjectTypeResolverInterface
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->enableNestedMutations()) {
            return $this->getSchemaRootObjectTypeResolver();
        }
        return $this->getQueryRootObjectTypeResolver();
    }
    /**
     * If nested mutations are enabled, use "Root".
     * Otherwise, use "Mutation"
     */
    public function getSchemaMutationRootObjectTypeResolver() : ?ObjectTypeResolverInterface
    {
        /** @var ComponentModelModuleConfiguration */
        $moduleConfiguration = App::getModule(ComponentModelModule::class)->getConfiguration();
        if (!$moduleConfiguration->enableMutations()) {
            return null;
        }
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        if ($moduleConfiguration->enableNestedMutations()) {
            return $this->getSchemaRootObjectTypeResolver();
        }
        return $this->getMutationRootObjectTypeResolver();
    }
    /**
     * @todo Implement
     */
    public function getSchemaSubscriptionRootTypeResolver() : ?ObjectTypeResolverInterface
    {
        return null;
    }
    protected function createRootObjectTypeSchemaDefinitionProvider(RootObjectTypeResolver $rootObjectTypeResolver) : UpstreamRootObjectTypeSchemaDefinitionProvider
    {
        return new RootObjectTypeSchemaDefinitionProvider($rootObjectTypeResolver);
    }
    /**
     * Global fields are only added if enabled
     */
    protected function skipExposingGlobalFieldsInSchema() : bool
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        return !$moduleConfiguration->exposeGlobalFieldsInGraphQLSchema();
    }
}
