<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Constants;

class AdminGraphQLEndpointGroups
{
    /**
     * This one is an empty string, as to express that if passing no param
     * then the default one is used
     */
    public const DEFAULT = '';
    public const PERSISTED_QUERY = 'persistedQuery';
    public const PLUGIN_OWN_USE = 'pluginOwnUse';
    public const BLOCK_EDITOR = 'blockEditor';
}
