<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\TaxonomyMutations\RelationalTypeDataLoaders\ObjectType\TaxonomyTermDoesNotExistErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class TaxonomyTermDoesNotExistErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    /**
     * @var \PoPCMSSchema\TaxonomyMutations\RelationalTypeDataLoaders\ObjectType\TaxonomyTermDoesNotExistErrorPayloadObjectTypeDataLoader|null
     */
    private $taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader;
    protected final function getTaxonomyTermDoesNotExistErrorPayloadObjectTypeDataLoader() : TaxonomyTermDoesNotExistErrorPayloadObjectTypeDataLoader
    {
        if ($this->taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader === null) {
            /** @var TaxonomyTermDoesNotExistErrorPayloadObjectTypeDataLoader */
            $taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(TaxonomyTermDoesNotExistErrorPayloadObjectTypeDataLoader::class);
            $this->taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader = $taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader;
        }
        return $this->taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'TaxonomyTermDoesNotExistErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The requested taxonomy does not exist"', 'taxonomy-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getTaxonomyTermDoesNotExistErrorPayloadObjectTypeDataLoader();
    }
}
