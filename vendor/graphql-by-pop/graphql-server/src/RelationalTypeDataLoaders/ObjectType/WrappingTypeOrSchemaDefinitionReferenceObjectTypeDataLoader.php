<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\ListWrappingType;
use GraphQLByPoP\GraphQLServer\ObjectModels\NonNullWrappingType;
use GraphQLByPoP\GraphQLServer\ObjectModels\SchemaDefinitionReferenceObjectInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\TypeInterface;
use GraphQLByPoP\GraphQLServer\ObjectModels\WrappingTypeInterface;
use GraphQLByPoP\GraphQLServer\Registries\SchemaDefinitionReferenceRegistryInterface;
use GraphQLByPoP\GraphQLServer\Syntax\GraphQLSyntaxServiceInterface;
use PoP\ComponentModel\Dictionaries\ObjectDictionaryInterface;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeDataLoader;
/** @internal */
class WrappingTypeOrSchemaDefinitionReferenceObjectTypeDataLoader extends AbstractObjectTypeDataLoader
{
    /**
     * @var \GraphQLByPoP\GraphQLServer\Registries\SchemaDefinitionReferenceRegistryInterface|null
     */
    private $schemaDefinitionReferenceRegistry;
    /**
     * @var \GraphQLByPoP\GraphQLServer\Syntax\GraphQLSyntaxServiceInterface|null
     */
    private $graphQLSyntaxService;
    /**
     * @var \PoP\ComponentModel\Dictionaries\ObjectDictionaryInterface|null
     */
    private $objectDictionary;
    public final function setSchemaDefinitionReferenceRegistry(SchemaDefinitionReferenceRegistryInterface $schemaDefinitionReferenceRegistry) : void
    {
        $this->schemaDefinitionReferenceRegistry = $schemaDefinitionReferenceRegistry;
    }
    protected final function getSchemaDefinitionReferenceRegistry() : SchemaDefinitionReferenceRegistryInterface
    {
        if ($this->schemaDefinitionReferenceRegistry === null) {
            /** @var SchemaDefinitionReferenceRegistryInterface */
            $schemaDefinitionReferenceRegistry = $this->instanceManager->getInstance(SchemaDefinitionReferenceRegistryInterface::class);
            $this->schemaDefinitionReferenceRegistry = $schemaDefinitionReferenceRegistry;
        }
        return $this->schemaDefinitionReferenceRegistry;
    }
    public final function setGraphQLSyntaxService(GraphQLSyntaxServiceInterface $graphQLSyntaxService) : void
    {
        $this->graphQLSyntaxService = $graphQLSyntaxService;
    }
    protected final function getGraphQLSyntaxService() : GraphQLSyntaxServiceInterface
    {
        if ($this->graphQLSyntaxService === null) {
            /** @var GraphQLSyntaxServiceInterface */
            $graphQLSyntaxService = $this->instanceManager->getInstance(GraphQLSyntaxServiceInterface::class);
            $this->graphQLSyntaxService = $graphQLSyntaxService;
        }
        return $this->graphQLSyntaxService;
    }
    public final function setObjectDictionary(ObjectDictionaryInterface $objectDictionary) : void
    {
        $this->objectDictionary = $objectDictionary;
    }
    protected final function getObjectDictionary() : ObjectDictionaryInterface
    {
        if ($this->objectDictionary === null) {
            /** @var ObjectDictionaryInterface */
            $objectDictionary = $this->instanceManager->getInstance(ObjectDictionaryInterface::class);
            $this->objectDictionary = $objectDictionary;
        }
        return $this->objectDictionary;
    }
    /**
     * The IDs can contain GraphQL's type wrappers, such as `[String]!`
     *
     * @param array<string|int> $ids
     * @return array<object|null>
     */
    public function getObjects(array $ids) : array
    {
        /** @var string[] $ids */
        return \array_map(\Closure::fromCallable([$this, 'getWrappingTypeOrSchemaDefinitionReferenceObject']), $ids);
    }
    /**
     * @return \GraphQLByPoP\GraphQLServer\ObjectModels\WrappingTypeInterface|\GraphQLByPoP\GraphQLServer\ObjectModels\SchemaDefinitionReferenceObjectInterface|null
     */
    protected function getWrappingTypeOrSchemaDefinitionReferenceObject(string $typeID)
    {
        // Check if the type is non-null or an array
        $isNonNullWrappingType = $this->getGraphQLSyntaxService()->isNonNullWrappingType($typeID);
        if ($isNonNullWrappingType || $this->getGraphQLSyntaxService()->isListWrappingType($typeID)) {
            // Store the single WrappingType instance in a dictionary
            $objectTypeResolverClass = \get_class();
            if ($this->getObjectDictionary()->has($objectTypeResolverClass, $typeID)) {
                return $this->getObjectDictionary()->get($objectTypeResolverClass, $typeID);
            }
            $wrappingType = null;
            if ($isNonNullWrappingType) {
                /** @var TypeInterface */
                $wrappedType = $this->getWrappingTypeOrSchemaDefinitionReferenceObject($this->getGraphQLSyntaxService()->extractWrappedTypeFromNonNullWrappingType($typeID));
                $wrappingType = new NonNullWrappingType($wrappedType);
            } else {
                /** @var TypeInterface */
                $wrappedType = $this->getWrappingTypeOrSchemaDefinitionReferenceObject($this->getGraphQLSyntaxService()->extractWrappedTypeFromListWrappingType($typeID));
                $wrappingType = new ListWrappingType($wrappedType);
            }
            $this->getObjectDictionary()->set($objectTypeResolverClass, $typeID, $wrappingType);
            return $wrappingType;
        }
        return $this->getSchemaDefinitionReferenceRegistry()->getSchemaDefinitionReferenceObject($typeID);
    }
}
