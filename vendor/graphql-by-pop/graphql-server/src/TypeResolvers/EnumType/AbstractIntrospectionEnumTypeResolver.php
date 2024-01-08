<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\TypeResolvers\EnumType;

use GraphQLByPoP\GraphQLServer\TypeResolvers\IntrospectionTypeResolverTrait;
use PoP\ComponentModel\TypeResolvers\EnumType\AbstractEnumTypeResolver;
/** @internal */
abstract class AbstractIntrospectionEnumTypeResolver extends AbstractEnumTypeResolver
{
    use IntrospectionTypeResolverTrait;
}
