<?php

declare (strict_types=1);
namespace GraphQLByPoP\GraphQLServer\AppStateProviderServices;

/** @internal */
interface GraphQLServerAppStateProviderServiceInterface
{
    /**
     * The required state to execute GraphQL queries.
     *
     * @return array<string,mixed>
     */
    public function getGraphQLRequestAppState() : array;
}
