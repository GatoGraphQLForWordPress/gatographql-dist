<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\RelationalTypeDataLoaders\ObjectType;

use PoPSchema\SchemaCommons\ObjectModels\ObjectMutationPayload;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractDictionaryObjectTypeDataLoader;
/** @internal */
class ObjectMutationPayloadObjectTypeDataLoader extends AbstractDictionaryObjectTypeDataLoader
{
    public function getObjectClass() : string
    {
        return ObjectMutationPayload::class;
    }
}
