<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\ObjectModels;

/** @internal */
interface HasPossibleTypesTypeInterface extends \GraphQLByPoP\GraphQLServer\ObjectModels\NamedTypeInterface
{
    /**
     * @return string[]
     */
    public function getPossibleTypeIDs() : array;
}
