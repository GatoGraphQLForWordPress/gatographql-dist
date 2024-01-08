<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Schema;

/** @internal */
class SchemaDefinitionTokens
{
    /**
     * Using "/" doesn't work with GraphQL Voyager!
     */
    const NAMESPACE_SEPARATOR = '_';
}
