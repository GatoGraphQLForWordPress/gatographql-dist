<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\TypeResolvers\ObjectType;

use PoP\ComponentModel\FieldResolvers\ObjectType\ObjectTypeFieldResolverInterface;
/** @internal */
interface UseRootAsSourceForSchemaObjectTypeResolverInterface
{
    public function isFieldNameConditionSatisfiedForSchema(ObjectTypeFieldResolverInterface $objectTypeFieldResolver, string $fieldName) : bool;
}
