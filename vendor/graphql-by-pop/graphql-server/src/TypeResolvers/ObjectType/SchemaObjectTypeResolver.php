<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\Schema;
use GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType\SchemaObjectTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class SchemaObjectTypeResolver extends \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\AbstractIntrospectionObjectTypeResolver
{
    /**
     * @var \GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType\SchemaObjectTypeDataLoader|null
     */
    private $schemaObjectTypeDataLoader;
    public final function setSchemaObjectTypeDataLoader(SchemaObjectTypeDataLoader $schemaObjectTypeDataLoader) : void
    {
        $this->schemaObjectTypeDataLoader = $schemaObjectTypeDataLoader;
    }
    protected final function getSchemaObjectTypeDataLoader() : SchemaObjectTypeDataLoader
    {
        if ($this->schemaObjectTypeDataLoader === null) {
            /** @var SchemaObjectTypeDataLoader */
            $schemaObjectTypeDataLoader = $this->instanceManager->getInstance(SchemaObjectTypeDataLoader::class);
            $this->schemaObjectTypeDataLoader = $schemaObjectTypeDataLoader;
        }
        return $this->schemaObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return '__Schema';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Schema type, to implement the introspection fields', 'graphql-server');
    }
    /**
     * @return string|int|null
     */
    public function getID(object $object)
    {
        /** @var Schema */
        $schema = $object;
        return $schema->getID();
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getSchemaObjectTypeDataLoader();
    }
}
