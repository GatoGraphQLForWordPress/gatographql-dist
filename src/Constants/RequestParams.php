<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Constants;

class RequestParams
{
    public const VIEW = 'view';
    public const VIEW_SOURCE = 'source';
    public const VIEW_GRAPHIQL = 'graphiql';
    public const VIEW_SCHEMA = 'schema';
    public const ACTION = 'action';
    public const ACTION_EXECUTE_QUERY = 'execute_query';
    public const CATEGORY = 'category';
    public const TAB = 'tab';
    public const TAB_DOCS = 'docs';
    public const MODULE = 'module';
    public const DOC = 'doc';
    public const PERSISTED_QUERY_ID = 'persisted_query_id';

    /**
     * Param used to obtain the configuration to apply to the requested
     * admin endpoint, based on an "endpointGroup".
     *
     * For instance, this plugin defines the configuration endpointGroup
     * "pluginOwnUse" to be used on the WordPress editor to
     * power this plugin's blocks. It shall be requested as:
     *
     *   /wp-admin/edit.php?page=gatographql&action=execute_query&endpoint_group=pluginOwnUse
     *
     * If the endpointGroup is not provided, the default admin endpoint
     * configuration is applied.
     */
    public const ENDPOINT_GROUP = 'endpoint_group';
}
