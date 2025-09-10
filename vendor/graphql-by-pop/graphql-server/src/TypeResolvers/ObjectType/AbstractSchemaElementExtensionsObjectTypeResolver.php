<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\SchemaDefinitionReferenceObjectInterface;
use GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType\SchemaDefinitionReferenceObjectTypeDataLoader;
use PoP\ComponentModel\FieldResolvers\InterfaceType\InterfaceTypeFieldResolverInterface;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
use PoP\ComponentModel\TypeResolvers\ObjectType\RemoveIdentifiableObjectInterfaceObjectTypeResolverTrait;
/** @internal */
abstract class AbstractSchemaElementExtensionsObjectTypeResolver extends \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\AbstractIntrospectionObjectTypeResolver
{
    use RemoveIdentifiableObjectInterfaceObjectTypeResolverTrait;
    private ?SchemaDefinitionReferenceObjectTypeDataLoader $schemaDefinitionReferenceObjectTypeDataLoader = null;
    protected final function getSchemaDefinitionReferenceObjectTypeDataLoader() : SchemaDefinitionReferenceObjectTypeDataLoader
    {
        if ($this->schemaDefinitionReferenceObjectTypeDataLoader === null) {
            /** @var SchemaDefinitionReferenceObjectTypeDataLoader */
            $schemaDefinitionReferenceObjectTypeDataLoader = $this->instanceManager->getInstance(SchemaDefinitionReferenceObjectTypeDataLoader::class);
            $this->schemaDefinitionReferenceObjectTypeDataLoader = $schemaDefinitionReferenceObjectTypeDataLoader;
        }
        return $this->schemaDefinitionReferenceObjectTypeDataLoader;
    }
    /**
     * Introspection names must start with "__".
     * However, when doing so, graphql-js throws an error:
     *
     * @see https://github.com/graphql-java/graphql-java/pull/2221#issuecomment-808044041
     *
     * To avoid it, prepend it with "_", as a temporary solution, until
     * the GraphQL spec and graphql-js deal with the issue.
     *
     * @see https://github.com/graphql/graphql-spec/issues/300#issuecomment-808047303
     */
    public final function getTypeName() : string
    {
        return '_' . $this->getIntrospectionTypeName();
    }
    protected abstract function getIntrospectionTypeName() : string;
    public function getID(object $object) : string|int|null
    {
        /** @var SchemaDefinitionReferenceObjectInterface $object */
        return $object->getID();
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getSchemaDefinitionReferenceObjectTypeDataLoader();
    }
    /**
     * Remove the IdentifiableObject interface
     *
     * @param InterfaceTypeFieldResolverInterface[] $interfaceTypeFieldResolvers
     * @return InterfaceTypeFieldResolverInterface[]
     */
    protected final function consolidateAllImplementedInterfaceTypeFieldResolvers(array $interfaceTypeFieldResolvers) : array
    {
        return $this->removeIdentifiableObjectInterfaceTypeFieldResolver(parent::consolidateAllImplementedInterfaceTypeFieldResolvers($interfaceTypeFieldResolvers));
    }
}
