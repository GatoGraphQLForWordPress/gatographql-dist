<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\TypeInterface;
use GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType\WrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class TypeObjectTypeResolver extends \GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType\AbstractIntrospectionObjectTypeResolver
{
    /**
     * @var \GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType\WrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader|null
     */
    private $wrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader;
    protected final function getWrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader() : WrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader
    {
        if ($this->wrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader === null) {
            /** @var WrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader */
            $wrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader = $this->instanceManager->getInstance(WrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader::class);
            $this->wrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader = $wrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader;
        }
        return $this->wrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return '__Type';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Representation of each GraphQL type in the graph', 'graphql-server');
    }
    /**
     * @return string|int|null
     */
    public function getID(object $object)
    {
        /** @var TypeInterface */
        $type = $object;
        return $type->getID();
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getWrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader();
    }
}
