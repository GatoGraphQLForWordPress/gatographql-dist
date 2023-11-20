<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostUserMutations\RelationalTypeDataLoaders\ObjectType;

use PoPCMSSchema\CustomPostUserMutations\ObjectModels\UserDoesNotExistErrorPayload;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractDictionaryObjectTypeDataLoader;
/** @internal */
class UserDoesNotExistErrorPayloadObjectTypeDataLoader extends AbstractDictionaryObjectTypeDataLoader
{
    protected function getObjectClass() : string
    {
        return UserDoesNotExistErrorPayload::class;
    }
}
