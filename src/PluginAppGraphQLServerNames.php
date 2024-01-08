<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL;

class PluginAppGraphQLServerNames
{
    /**
     * GraphQL server that processes the request
     * (i.e. the standard GraphQL server powering the API)
     */
    public const EXTERNAL = 'external';
    /**
     * GraphQL server that processes internal executions
     * (i.e. initialized/invoked via PHP code)
     */
    public const INTERNAL = 'internal';
}
