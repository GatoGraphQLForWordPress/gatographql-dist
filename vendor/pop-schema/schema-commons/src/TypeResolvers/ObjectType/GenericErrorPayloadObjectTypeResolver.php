<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\TypeResolvers\ObjectType;

use PoPSchema\SchemaCommons\RelationalTypeDataLoaders\ObjectType\GenericErrorPayloadObjectTypeDataLoader;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class GenericErrorPayloadObjectTypeResolver extends \PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPSchema\SchemaCommons\RelationalTypeDataLoaders\ObjectType\GenericErrorPayloadObjectTypeDataLoader|null
     */
    private $genericErrorPayloadObjectTypeDataLoader;
    public final function setGenericErrorPayloadObjectTypeDataLoader(GenericErrorPayloadObjectTypeDataLoader $genericErrorPayloadObjectTypeDataLoader) : void
    {
        $this->genericErrorPayloadObjectTypeDataLoader = $genericErrorPayloadObjectTypeDataLoader;
    }
    protected final function getGenericErrorPayloadObjectTypeDataLoader() : GenericErrorPayloadObjectTypeDataLoader
    {
        if ($this->genericErrorPayloadObjectTypeDataLoader === null) {
            /** @var GenericErrorPayloadObjectTypeDataLoader */
            $genericErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(GenericErrorPayloadObjectTypeDataLoader::class);
            $this->genericErrorPayloadObjectTypeDataLoader = $genericErrorPayloadObjectTypeDataLoader;
        }
        return $this->genericErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'GenericErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Generic error payload', 'schema-commons');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getGenericErrorPayloadObjectTypeDataLoader();
    }
}
