<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\ObjectType;

use PoPCMSSchema\CustomPostMutations\ObjectModels\CustomPostAncestorRecursionErrorPayload;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractDictionaryObjectTypeDataLoader;
/** @internal */
class CustomPostAncestorRecursionErrorPayloadObjectTypeDataLoader extends AbstractDictionaryObjectTypeDataLoader
{
    public function getObjectClass() : string
    {
        return CustomPostAncestorRecursionErrorPayload::class;
    }
}
