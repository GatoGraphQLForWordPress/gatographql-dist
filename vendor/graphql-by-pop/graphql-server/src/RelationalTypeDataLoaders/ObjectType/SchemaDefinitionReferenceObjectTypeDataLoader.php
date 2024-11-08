<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType;

use GraphQLByPoP\GraphQLServer\Registries\SchemaDefinitionReferenceRegistryInterface;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeDataLoader;
/** @internal */
class SchemaDefinitionReferenceObjectTypeDataLoader extends AbstractObjectTypeDataLoader
{
    /**
     * @var \GraphQLByPoP\GraphQLServer\Registries\SchemaDefinitionReferenceRegistryInterface|null
     */
    private $schemaDefinitionReferenceRegistry;
    protected final function getSchemaDefinitionReferenceRegistry() : SchemaDefinitionReferenceRegistryInterface
    {
        if ($this->schemaDefinitionReferenceRegistry === null) {
            /** @var SchemaDefinitionReferenceRegistryInterface */
            $schemaDefinitionReferenceRegistry = $this->instanceManager->getInstance(SchemaDefinitionReferenceRegistryInterface::class);
            $this->schemaDefinitionReferenceRegistry = $schemaDefinitionReferenceRegistry;
        }
        return $this->schemaDefinitionReferenceRegistry;
    }
    /**
     * @param array<string|int> $ids
     * @return array<object|null>
     */
    public function getObjects(array $ids) : array
    {
        /** @var string[] $ids */
        return \array_map(\Closure::fromCallable([$this->getSchemaDefinitionReferenceRegistry(), 'getSchemaDefinitionReferenceObject']), $ids);
    }
}
