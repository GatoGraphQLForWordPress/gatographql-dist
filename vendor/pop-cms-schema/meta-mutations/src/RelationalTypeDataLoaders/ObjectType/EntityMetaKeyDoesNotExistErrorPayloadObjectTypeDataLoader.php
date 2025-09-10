<?php

declare (strict_types=1);
namespace PoPCMSSchema\MetaMutations\RelationalTypeDataLoaders\ObjectType;

use PoPCMSSchema\MetaMutations\ObjectModels\EntityMetaKeyDoesNotExistErrorPayload;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractDictionaryObjectTypeDataLoader;
/** @internal */
class EntityMetaKeyDoesNotExistErrorPayloadObjectTypeDataLoader extends AbstractDictionaryObjectTypeDataLoader
{
    public function getObjectClass() : string
    {
        return EntityMetaKeyDoesNotExistErrorPayload::class;
    }
}
