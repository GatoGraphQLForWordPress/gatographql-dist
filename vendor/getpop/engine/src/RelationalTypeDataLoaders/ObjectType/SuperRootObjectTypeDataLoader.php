<?php

declare (strict_types=1);
namespace PoP\Engine\RelationalTypeDataLoaders\ObjectType;

use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeDataLoader;
use PoP\Engine\ObjectModels\SuperRoot;
/** @internal */
class SuperRootObjectTypeDataLoader extends AbstractObjectTypeDataLoader
{
    /**
     * @var \PoP\Engine\ObjectModels\SuperRoot|null
     */
    private $superRoot;
    public final function setSuperRoot(SuperRoot $superRoot) : void
    {
        $this->superRoot = $superRoot;
    }
    protected final function getSuperRoot() : SuperRoot
    {
        if ($this->superRoot === null) {
            /** @var SuperRoot */
            $superRoot = $this->instanceManager->getInstance(SuperRoot::class);
            $this->superRoot = $superRoot;
        }
        return $this->superRoot;
    }
    /**
     * @param array<string|int> $ids
     * @return array<object|null>
     */
    public function getObjects(array $ids) : array
    {
        return [$this->getSuperRoot()];
    }
}
