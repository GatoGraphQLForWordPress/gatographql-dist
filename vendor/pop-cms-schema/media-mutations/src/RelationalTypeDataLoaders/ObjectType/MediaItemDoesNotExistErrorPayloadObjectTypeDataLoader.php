<?php

declare (strict_types=1);
namespace PoPCMSSchema\MediaMutations\RelationalTypeDataLoaders\ObjectType;

use PoPCMSSchema\MediaMutations\ObjectModels\MediaItemDoesNotExistErrorPayload;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractDictionaryObjectTypeDataLoader;
/** @internal */
class MediaItemDoesNotExistErrorPayloadObjectTypeDataLoader extends AbstractDictionaryObjectTypeDataLoader
{
    public function getObjectClass() : string
    {
        return MediaItemDoesNotExistErrorPayload::class;
    }
}
