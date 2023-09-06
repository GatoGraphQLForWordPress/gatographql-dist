<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\EnumValue;
use GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType\SchemaDefinitionReferenceObjectTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
class EnumValueObjectTypeResolver extends \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\AbstractIntrospectionObjectTypeResolver
{
    /**
     * @var \GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType\SchemaDefinitionReferenceObjectTypeDataLoader|null
     */
    private $schemaDefinitionReferenceObjectTypeDataLoader;
    public final function setSchemaDefinitionReferenceObjectTypeDataLoader(SchemaDefinitionReferenceObjectTypeDataLoader $schemaDefinitionReferenceObjectTypeDataLoader) : void
    {
        $this->schemaDefinitionReferenceObjectTypeDataLoader = $schemaDefinitionReferenceObjectTypeDataLoader;
    }
    protected final function getSchemaDefinitionReferenceObjectTypeDataLoader() : SchemaDefinitionReferenceObjectTypeDataLoader
    {
        if ($this->schemaDefinitionReferenceObjectTypeDataLoader === null) {
            /** @var SchemaDefinitionReferenceObjectTypeDataLoader */
            $schemaDefinitionReferenceObjectTypeDataLoader = $this->instanceManager->getInstance(SchemaDefinitionReferenceObjectTypeDataLoader::class);
            $this->schemaDefinitionReferenceObjectTypeDataLoader = $schemaDefinitionReferenceObjectTypeDataLoader;
        }
        return $this->schemaDefinitionReferenceObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return '__EnumValue';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Representation of an Enum value in GraphQL', 'graphql-server');
    }
    /**
     * @return string|int|null
     */
    public function getID(object $object)
    {
        /** @var EnumValue */
        $enumValue = $object;
        return $enumValue->getID();
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getSchemaDefinitionReferenceObjectTypeDataLoader();
    }
}
