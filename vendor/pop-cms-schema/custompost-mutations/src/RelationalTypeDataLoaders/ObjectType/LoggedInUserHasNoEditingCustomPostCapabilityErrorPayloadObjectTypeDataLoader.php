<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\RelationalTypeDataLoaders\ObjectType;

use PoPCMSSchema\CustomPostMutations\ObjectModels\LoggedInUserHasNoEditingCustomPostCapabilityErrorPayload;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractDictionaryObjectTypeDataLoader;
/** @internal */
class LoggedInUserHasNoEditingCustomPostCapabilityErrorPayloadObjectTypeDataLoader extends AbstractDictionaryObjectTypeDataLoader
{
    protected function getObjectClass() : string
    {
        return LoggedInUserHasNoEditingCustomPostCapabilityErrorPayload::class;
    }
}
