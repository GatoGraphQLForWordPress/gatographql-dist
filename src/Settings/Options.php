<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Settings;

/**
 * Option names.
 *
 * They must be namespaced (via the OptionNamespacer service),
 * so that they all start with "gatographql-"
 */
class Options
{
    /**
     * Option name under which to store the endpoint and client paths, defined by the user
     */
    public const ENDPOINT_CONFIGURATION = 'endpoint-configuration';
    /**
     * Option name under which to store the "Schema Configuration" values, defined by the user
     */
    public const SCHEMA_CONFIGURATION = 'schema-configuration';
    /**
     * Option name under which to store the "Schema Type Configuration" values, defined by the user
     */
    public const SCHEMA_TYPE_CONFIGURATION = 'schema-type-configuration';
    /**
     * Option name under which to store the server configuration, defined by the user
     */
    public const SERVER_CONFIGURATION = 'server-configuration';
    /**
     * Option name under which to store the Plugin Configuration, defined by the user
     */
    public const PLUGIN_CONFIGURATION = 'plugin-configuration';
    /**
     * Option name under which to store the Service Configuration, defined by the user
     */
    public const SERVICE_CONFIGURATION = 'service-configuration';
    /**
     * Option name under which to store the Plugin Integration Configuration, defined by the user
     */
    public const PLUGIN_INTEGRATION_CONFIGURATION = 'plugin-integration-configuration';
    /**
     * Option name under which to store the License Keys, defined by the user
     */
    public const API_KEYS = 'api-keys';
    /**
     * Option name for Plugin Management.
     *
     * This option won't be actually stored to DB, but it's
     * still needed to render the corresponding form.
     */
    public const PLUGIN_MANAGEMENT = 'plugin-management';
    /**
     * Option name under which to store the enabled/disabled Modules
     */
    public const MODULES = 'modules';
    /**
     * Option name under which to store the timestamps from the last
     * settings/modules write to the DB
     */
    public const TIMESTAMPS = 'timestamps';
    /**
     * Option name under which to store the Log entries count
     */
    public const LOG_COUNTS = 'log-counts';
    /**
     * Option name under which to store transient data, to calculate
     * operations between request and request
     */
    public const TRANSIENTS = 'transients';
    /**
     * Store the license data for all bundles/extensions that
     * have been activated
     */
    public const COMMERCIAL_EXTENSION_ACTIVATED_LICENSE_ENTRIES = 'commercial-extension-activated-license-entries';
}
