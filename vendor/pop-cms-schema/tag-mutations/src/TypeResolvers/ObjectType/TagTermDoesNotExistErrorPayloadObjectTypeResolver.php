<?php

declare (strict_types=1);
namespace PoPCMSSchema\TagMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\ObjectType\TagTermDoesNotExistErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class TagTermDoesNotExistErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\TagMutations\RelationalTypeDataLoaders\ObjectType\TagTermDoesNotExistErrorPayloadObjectTypeDataLoader|null
     */
    private $tagDoesNotExistErrorPayloadObjectTypeDataLoader;
    protected final function getTagTermDoesNotExistErrorPayloadObjectTypeDataLoader() : TagTermDoesNotExistErrorPayloadObjectTypeDataLoader
    {
        if ($this->tagDoesNotExistErrorPayloadObjectTypeDataLoader === null) {
            /** @var TagTermDoesNotExistErrorPayloadObjectTypeDataLoader */
            $tagDoesNotExistErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(TagTermDoesNotExistErrorPayloadObjectTypeDataLoader::class);
            $this->tagDoesNotExistErrorPayloadObjectTypeDataLoader = $tagDoesNotExistErrorPayloadObjectTypeDataLoader;
        }
        return $this->tagDoesNotExistErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'TagTermDoesNotExistErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The requested tag does not exist"', 'tag-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getTagTermDoesNotExistErrorPayloadObjectTypeDataLoader();
    }
}
