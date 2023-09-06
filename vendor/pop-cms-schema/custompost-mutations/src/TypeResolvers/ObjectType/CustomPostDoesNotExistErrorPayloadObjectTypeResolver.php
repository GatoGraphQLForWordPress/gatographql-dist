<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\ObjectType\CustomPostDoesNotExistErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
class CustomPostDoesNotExistErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\ObjectType\CustomPostDoesNotExistErrorPayloadObjectTypeDataLoader|null
     */
    private $customPostDoesNotExistErrorPayloadObjectTypeDataLoader;
    public final function setCustomPostDoesNotExistErrorPayloadObjectTypeDataLoader(CustomPostDoesNotExistErrorPayloadObjectTypeDataLoader $customPostDoesNotExistErrorPayloadObjectTypeDataLoader) : void
    {
        $this->customPostDoesNotExistErrorPayloadObjectTypeDataLoader = $customPostDoesNotExistErrorPayloadObjectTypeDataLoader;
    }
    protected final function getCustomPostDoesNotExistErrorPayloadObjectTypeDataLoader() : CustomPostDoesNotExistErrorPayloadObjectTypeDataLoader
    {
        if ($this->customPostDoesNotExistErrorPayloadObjectTypeDataLoader === null) {
            /** @var CustomPostDoesNotExistErrorPayloadObjectTypeDataLoader */
            $customPostDoesNotExistErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(CustomPostDoesNotExistErrorPayloadObjectTypeDataLoader::class);
            $this->customPostDoesNotExistErrorPayloadObjectTypeDataLoader = $customPostDoesNotExistErrorPayloadObjectTypeDataLoader;
        }
        return $this->customPostDoesNotExistErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'CustomPostDoesNotExistErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The requested custom post does not exist"', 'customposts');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getCustomPostDoesNotExistErrorPayloadObjectTypeDataLoader();
    }
}
