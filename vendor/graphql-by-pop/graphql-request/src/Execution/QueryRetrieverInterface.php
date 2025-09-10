<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLRequest\Execution;

use GraphQLByPoP\GraphQLRequest\ObjectModels\GraphQLQueryPayload;
/** @internal */
interface QueryRetrieverInterface
{
    public function extractRequestedGraphQLQueryPayload() : GraphQLQueryPayload;
}
