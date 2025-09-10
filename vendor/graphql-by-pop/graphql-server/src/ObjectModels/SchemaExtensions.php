<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\ObjectModels;

use PoP\ComponentModel\Schema\SchemaDefinition;
/** @internal */
class SchemaExtensions extends \GraphQLByPoP\GraphQLServer\ObjectModels\AbstractSchemaDefinitionReferenceObject
{
    public function isSchemaNamespaced() : bool
    {
        return $this->schemaDefinition[SchemaDefinition::SCHEMA_IS_NAMESPACED] ?? \false;
    }
}
