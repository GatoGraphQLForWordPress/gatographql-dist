<?php

declare (strict_types=1);
namespace PoPCMSSchema\TaxonomyMutations\TypeResolvers\ObjectType;

use PoPCMSSchema\TaxonomyMutations\RelationalTypeDataLoaders\ObjectType\TaxonomyDoesNotExistErrorPayloadObjectTypeDataLoader;
use PoPSchema\SchemaCommons\TypeResolvers\ObjectType\AbstractErrorPayloadObjectTypeResolver;
use PoP\ComponentModel\RelationalTypeDataLoaders\RelationalTypeDataLoaderInterface;
/** @internal */
class TaxonomyDoesNotExistErrorPayloadObjectTypeResolver extends AbstractErrorPayloadObjectTypeResolver
{
    private ?TaxonomyDoesNotExistErrorPayloadObjectTypeDataLoader $taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader = null;
    protected final function getTaxonomyDoesNotExistErrorPayloadObjectTypeDataLoader() : TaxonomyDoesNotExistErrorPayloadObjectTypeDataLoader
    {
        if ($this->taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader === null) {
            /** @var TaxonomyDoesNotExistErrorPayloadObjectTypeDataLoader */
            $taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader = $this->instanceManager->getInstance(TaxonomyDoesNotExistErrorPayloadObjectTypeDataLoader::class);
            $this->taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader = $taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader;
        }
        return $this->taxonomyDoesNotExistErrorPayloadObjectTypeDataLoader;
    }
    public function getTypeName() : string
    {
        return 'TaxonomyDoesNotExistErrorPayload';
    }
    public function getTypeDescription() : ?string
    {
        return $this->__('Error payload for: "The requested taxonomy does not exist"', 'taxonomy-mutations');
    }
    public function getRelationalTypeDataLoader() : RelationalTypeDataLoaderInterface
    {
        return $this->getTaxonomyDoesNotExistErrorPayloadObjectTypeDataLoader();
    }
}
