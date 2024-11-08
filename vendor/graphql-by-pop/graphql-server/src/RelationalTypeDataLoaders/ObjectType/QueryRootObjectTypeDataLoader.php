<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\RelationalTypeDataLoaders\ObjectType;

use GraphQLByPoP\GraphQLServer\ObjectModels\QueryRoot;
use PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeDataLoader;
/** @internal */
class QueryRootObjectTypeDataLoader extends AbstractObjectTypeDataLoader
{
    /**
     * @var \GraphQLByPoP\GraphQLServer\ObjectModels\QueryRoot|null
     */
    private $queryRoot;
    protected final function getQueryRoot() : QueryRoot
    {
        if ($this->queryRoot === null) {
            /** @var QueryRoot */
            $queryRoot = $this->instanceManager->getInstance(QueryRoot::class);
            $this->queryRoot = $queryRoot;
        }
        return $this->queryRoot;
    }
    /**
     * @param array<string|int> $ids
     * @return array<object|null>
     */
    public function getObjects(array $ids) : array
    {
        return [$this->getQueryRoot()];
    }
}
