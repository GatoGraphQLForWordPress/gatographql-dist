<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\ObjectModels;

/** @internal */
interface SchemaDefinitionReferenceObjectInterface
{
    /**
     * @return array<string,mixed>
     */
    public function getSchemaDefinitionPath() : array;
    public function getID() : string;
}
