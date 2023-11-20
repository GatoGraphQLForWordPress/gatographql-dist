<?php

declare (strict_types=1);
namespace PoP\ComponentModel\RelationalTypeDataLoaders;

/** @internal */
interface RelationalTypeDataLoaderInterface
{
    /**
     * @param array<string|int> $ids
     * @return array<object|null>
     */
    public function getObjects(array $ids) : array;
}
