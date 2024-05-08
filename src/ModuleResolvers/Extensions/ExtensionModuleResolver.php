<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers\Extensions;

use GatoGraphQL\GatoGraphQL\Plugin;

class ExtensionModuleResolver extends AbstractExtensionModuleResolver
{
    public const ACCESS_CONTROL = Plugin::NAMESPACE . '\\extensions\\access-control';
    public const ACCESS_CONTROL_VISITOR_IP = Plugin::NAMESPACE . '\\extensions\\access-control-visitor-ip';
    public const AUTOMATION = Plugin::NAMESPACE . '\\extensions\\automation';
    public const CACHE_CONTROL = Plugin::NAMESPACE . '\\extensions\\cache-control';
    public const CONDITIONAL_FIELD_MANIPULATION = Plugin::NAMESPACE . '\\extensions\\conditional-field-manipulation';
    public const DEPRECATION_NOTIFIER = Plugin::NAMESPACE . '\\extensions\\deprecation-notifier';
    public const EMAIL_SENDER = Plugin::NAMESPACE . '\\extensions\\email-sender';
    public const EVENTS_MANAGER = Plugin::NAMESPACE . '\\extensions\\events-manager';
    public const FIELD_DEFAULT_VALUE = Plugin::NAMESPACE . '\\extensions\\field-default-value';
    public const FIELD_DEPRECATION = Plugin::NAMESPACE . '\\extensions\\field-deprecation';
    public const FIELD_ON_FIELD = Plugin::NAMESPACE . '\\extensions\\field-on-field';
    public const FIELD_RESOLUTION_CACHING = Plugin::NAMESPACE . '\\extensions\\field-resolution-caching';
    public const FIELD_RESPONSE_REMOVAL = Plugin::NAMESPACE . '\\extensions\\field-response-removal';
    public const FIELD_TO_INPUT = Plugin::NAMESPACE . '\\extensions\\field-to-input';
    public const FIELD_VALUE_ITERATION_AND_MANIPULATION = Plugin::NAMESPACE . '\\extensions\\field-value-iteration-and-manipulation';
    public const GOOGLE_TRANSLATE = Plugin::NAMESPACE . '\\extensions\\google-translate';
    public const HELPER_FUNCTION_COLLECTION = Plugin::NAMESPACE . '\\extensions\\helper-function-collection';
    public const HTTP_CLIENT = Plugin::NAMESPACE . '\\extensions\\http-client';
    public const HTTP_REQUEST_VIA_SCHEMA = Plugin::NAMESPACE . '\\extensions\\http-request-via-schema';
    public const INTERNAL_GRAPHQL_SERVER = Plugin::NAMESPACE . '\\extensions\\internal-graphql-server';
    public const LOW_LEVEL_PERSISTED_QUERY_EDITING = Plugin::NAMESPACE . '\\extensions\\low-level-persisted-query-editing';
    public const MULTIPLE_QUERY_EXECUTION = Plugin::NAMESPACE . '\\extensions\\multiple-query-execution';
    public const PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA = Plugin::NAMESPACE . '\\extensions\\php-constants-and-environment-variables-via-schema';
    public const PHP_FUNCTIONS_VIA_SCHEMA = Plugin::NAMESPACE . '\\extensions\\php-functions-via-schema';
    public const POLYLANG = Plugin::NAMESPACE . '\\extensions\\polylang';
    public const RESPONSE_ERROR_TRIGGER = Plugin::NAMESPACE . '\\extensions\\response-error-trigger';
    public const SCHEMA_EDITING_ACCESS = Plugin::NAMESPACE . '\\extensions\\schema-editing-access';

    /**
     * @return string[]
     */
    public function getModulesToResolve(): array
    {
        return [
            self::ACCESS_CONTROL,
            self::ACCESS_CONTROL_VISITOR_IP,
            self::AUTOMATION,
            self::CACHE_CONTROL,
            self::CONDITIONAL_FIELD_MANIPULATION,
            self::DEPRECATION_NOTIFIER,
            self::EMAIL_SENDER,
            self::EVENTS_MANAGER,
            self::FIELD_DEFAULT_VALUE,
            self::FIELD_DEPRECATION,
            self::FIELD_ON_FIELD,
            self::FIELD_RESOLUTION_CACHING,
            self::FIELD_RESPONSE_REMOVAL,
            self::FIELD_TO_INPUT,
            self::FIELD_VALUE_ITERATION_AND_MANIPULATION,
            self::GOOGLE_TRANSLATE,
            self::HELPER_FUNCTION_COLLECTION,
            self::HTTP_CLIENT,
            self::HTTP_REQUEST_VIA_SCHEMA,
            self::INTERNAL_GRAPHQL_SERVER,
            self::LOW_LEVEL_PERSISTED_QUERY_EDITING,
            self::MULTIPLE_QUERY_EXECUTION,
            self::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA,
            self::PHP_FUNCTIONS_VIA_SCHEMA,
            self::POLYLANG,
            self::RESPONSE_ERROR_TRIGGER,
            self::SCHEMA_EDITING_ACCESS,
        ];
    }

    public function getName(string $module): string
    {
        switch ($module) {
            case self::ACCESS_CONTROL:
                return \__('Access Control', 'gatographql');
            case self::ACCESS_CONTROL_VISITOR_IP:
                return \__('Access Control: Visitor IP', 'gatographql');
            case self::AUTOMATION:
                return \__('Automation', 'gatographql');
            case self::CACHE_CONTROL:
                return \__('Cache Control', 'gatographql');
            case self::CONDITIONAL_FIELD_MANIPULATION:
                return \__('Conditional Field Manipulation', 'gatographql');
            case self::DEPRECATION_NOTIFIER:
                return \__('Deprecation Notifier', 'gatographql');
            case self::EMAIL_SENDER:
                return \__('Email Sender', 'gatographql');
            case self::EVENTS_MANAGER:
                return \__('Events Manager', 'gatographql');
            case self::FIELD_DEFAULT_VALUE:
                return \__('Field Default Value', 'gatographql');
            case self::FIELD_DEPRECATION:
                return \__('Field Deprecation', 'gatographql');
            case self::FIELD_ON_FIELD:
                return \__('Field on Field', 'gatographql');
            case self::FIELD_RESOLUTION_CACHING:
                return \__('Field Resolution Caching', 'gatographql');
            case self::FIELD_RESPONSE_REMOVAL:
                return \__('Field Response Removal', 'gatographql');
            case self::FIELD_TO_INPUT:
                return \__('Field To Input', 'gatographql');
            case self::FIELD_VALUE_ITERATION_AND_MANIPULATION:
                return \__('Field Value Iteration and Manipulation', 'gatographql');
            case self::GOOGLE_TRANSLATE:
                return \__('Google Translate', 'gatographql');
            case self::HELPER_FUNCTION_COLLECTION:
                return \__('Helper Function Collection', 'gatographql');
            case self::HTTP_CLIENT:
                return \__('HTTP Client', 'gatographql');
            case self::HTTP_REQUEST_VIA_SCHEMA:
                return \__('HTTP Request via Schema', 'gatographql');
            case self::INTERNAL_GRAPHQL_SERVER:
                return \__('Internal GraphQL Server', 'gatographql');
            case self::LOW_LEVEL_PERSISTED_QUERY_EDITING:
                return \__('Low-Level Persisted Query Editing', 'gatographql');
            case self::MULTIPLE_QUERY_EXECUTION:
                return \__('Multiple Query Execution', 'gatographql');
            case self::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA:
                return \__('PHP Constants and Environment Variables via Schema', 'gatographql');
            case self::PHP_FUNCTIONS_VIA_SCHEMA:
                return \__('PHP Functions via Schema', 'gatographql');
            case self::POLYLANG:
                return \__('Polylang', 'gatographql');
            case self::RESPONSE_ERROR_TRIGGER:
                return \__('Response Error Trigger', 'gatographql');
            case self::SCHEMA_EDITING_ACCESS:
                return \__('Schema Editing Access', 'gatographql');
            default:
                return $module;
        }
    }

    public function getDescription(string $module): string
    {
        switch ($module) {
            case self::ACCESS_CONTROL:
                return \__('Grant granular access to the schema, based on the user being logged-in (or not), having a certain role or capability, and more.', 'gatographql');
            case self::ACCESS_CONTROL_VISITOR_IP:
                return \__('Grant access to the schema based on the visitor\'s IP address (Access Control extension is required).', 'gatographql');
            case self::AUTOMATION:
                return \__('Use GraphQL to automate tasks in your app: Execute queries when some event happens, chain queries, and schedule and trigger queries via WP-Cron. (The Internal GraphQL Server extension is required).', 'gatographql');
            case self::CACHE_CONTROL:
                return \__('Provide HTTP Caching for endpoints accessed via GET, with the max-age value automatically calculated from the query.', 'gatographql');
            case self::CONDITIONAL_FIELD_MANIPULATION:
                return \__('Apply a directive on a field only if some condition is met.', 'gatographql');
            case self::DEPRECATION_NOTIFIER:
                return \__('Send deprecations in the response to the query (and not only when doing introspection).', 'gatographql');
            case self::EMAIL_SENDER:
                return \__('Send emails via global mutation <code>_sendEmail</code>.', 'gatographql');
            case self::EVENTS_MANAGER:
                return \__('Integration with plugin "Events Manager", adding fields to the schema to fetch event data.', 'gatographql');
            case self::FIELD_DEFAULT_VALUE:
                return \__('Set a field to some default value (whenever it is <code>null</code> or empty).', 'gatographql');
            case self::FIELD_DEPRECATION:
                return \__('Deprecate fields, and explain how to replace them, through a user interface.', 'gatographql');
            case self::FIELD_ON_FIELD:
                return \__('Manipulate the value of a field by applying some other field on it.', 'gatographql');
            case self::FIELD_RESOLUTION_CACHING:
                return \__('Cache and retrieve the response for expensive field operations.', 'gatographql');
            case self::FIELD_RESPONSE_REMOVAL:
                return \__('Remove the output of a field from the response.', 'gatographql');
            case self::FIELD_TO_INPUT:
                return \__('Retrieve the value of a field, manipulate it, and input it into another field, all within the same query.', 'gatographql');
            case self::FIELD_VALUE_ITERATION_AND_MANIPULATION:
                return \__('Iterate and manipulate the value elements of array and object fields.', 'gatographql');
            case self::GOOGLE_TRANSLATE:
                return \__('Translate content to multiple languages using the Google Translate API.', 'gatographql');
            case self::HELPER_FUNCTION_COLLECTION:
                return \__('Collection of fields providing useful functionality.', 'gatographql');
            case self::HTTP_CLIENT:
                return \__('Addition of fields to execute HTTP requests against a webserver and fetch their response.', 'gatographql');
            case self::HTTP_REQUEST_VIA_SCHEMA:
                return \__('Addition of fields to retrieve the current HTTP request data.', 'gatographql');
            case self::INTERNAL_GRAPHQL_SERVER:
                return \__('Execute GraphQL queries directly within your application, using PHP code.', 'gatographql');
            case self::LOW_LEVEL_PERSISTED_QUERY_EDITING:
                return \__('Make normally-hidden directives (which inject some functionality into the GraphQL server) visible when editing a persisted query.', 'gatographql');
            case self::MULTIPLE_QUERY_EXECUTION:
                return \__('Combine multiple queries into a single query, sharing state across them and executing them in the requested order.', 'gatographql');
            case self::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA:
                return \__('Query the value from an environment variable or PHP constant.', 'gatographql');
            case self::PHP_FUNCTIONS_VIA_SCHEMA:
                return \__('Manipulate the field output using standard programming language functions available in PHP.', 'gatographql');
            case self::POLYLANG:
                return \__('Integration with plugin "Polylang", adding fields to the schema to fetch multilingual data.', 'gatographql');
            case self::RESPONSE_ERROR_TRIGGER:
                return \__('Explicitly add an error entry to the response to trigger the failure of the GraphQL request (whenever a field does not meet the expected conditions).', 'gatographql');
            case self::SCHEMA_EDITING_ACCESS:
                return \__('Grant access to users other than admins to edit the GraphQL schema.', 'gatographql');
            default:
                return parent::getDescription($module);
        }
    }
}
