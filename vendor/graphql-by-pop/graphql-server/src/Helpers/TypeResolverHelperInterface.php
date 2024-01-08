<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\Helpers;

/** @internal */
interface TypeResolverHelperInterface
{
    /**
     * Return the list of fieldNames that are mandatory to all ObjectTypeResolvers
     *
     * @return string[]
     */
    public function getObjectTypeResolverMandatoryFields() : array;
}
