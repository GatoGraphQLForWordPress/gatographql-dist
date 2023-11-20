<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\ObjectType;

use PoPSchema\SchemaCommons\RelationalTypeDataLoaders\ObjectType\ObjectMutationPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractTransientEntityOperationPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
abstract class AbstractObjectMutationPayloadObjectTypeResolver extends AbstractTransientEntityOperationPayloadObjectTypeResolver
{
    /**
     * @var \PoPSchema\SchemaCommons\RelationalTypeDataLoaders\ObjectType\ObjectMutationPayloadObjectTypeDataLoader|null
     */
    private $objectMutationPayloadObjectTypeDataLoader;
    public final function setObjectMutationPayloadObjectTypeDataLoader(ObjectMutationPayloadObjectTypeDataLoader $objectMutationPayloadObjectTypeDataLoader) : void
    {
        $this->objectMutationPayloadObjectTypeDataLoader = $objectMutationPayloadObjectTypeDataLoader;
    }
    protected final function getObjectMutationPayloadObjectTypeDataLoader() : ObjectMutationPayloadObjectTypeDataLoader
    {
        if ($this->objectMutationPayloadObjectTypeDataLoader === null) {
            /** @var ObjectMutationPayloadObjectTypeDataLoader */
            $objectMutationPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(ObjectMutationPayloadObjectTypeDataLoader::class);
            $this->objectMutationPayloadObjectTypeDataLoader = $objectMutationPayloadObjectTypeDataLoader;
        }
        return $this->objectMutationPayloadObjectTypeDataLoader;
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getObjectMutationPayloadObjectTypeDataLoader();
    }
}
