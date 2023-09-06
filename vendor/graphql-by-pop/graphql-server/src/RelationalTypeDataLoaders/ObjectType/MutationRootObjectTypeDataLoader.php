<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\MutationRoot;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeDataLoader;
class MutationRootObjectTypeDataLoader extends AbstractObjectTypeDataLoader
{
    /**
     * @var \GraphQLByPoP\GraphQLServer\ObjectModels\MutationRoot|null
     */
    private $mutationRoot;
    public final function setMutationRoot(MutationRoot $mutationRoot) : void
    {
        $this->mutationRoot = $mutationRoot;
    }
    protected final function getMutationRoot() : MutationRoot
    {
        if ($this->mutationRoot === null) {
            /** @var MutationRoot */
            $mutationRoot = $this->instanceManager->getInstance(MutationRoot::class);
            $this->mutationRoot = $mutationRoot;
        }
        return $this->mutationRoot;
    }
    /**
     * @param array<string|int> $ids
     * @return array<object|null>
     */
    public function getObjects(array $ids) : array
    {
        return [$this->getMutationRoot()];
    }
}
