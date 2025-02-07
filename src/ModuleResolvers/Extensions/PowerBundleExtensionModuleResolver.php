<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers\Extensions;

use GatoGraphQL\GatoGraphQL\App;
use GatoGraphQL\GatoGraphQL\Module;
use GatoGraphQL\GatoGraphQL\ModuleConfiguration;
use GatoGraphQL\GatoGraphQL\Plugin;
use GatoGraphQL\GatoGraphQL\PluginApp;
use GatoGraphQL\GatoGraphQL\PluginStaticModuleConfiguration;

class PowerBundleExtensionModuleResolver extends AbstractBundleExtensionModuleResolver
{
    // public const PRO = Plugin::NAMESPACE . '\\bundle-extensions\\pro';

    // public const ALL_EXTENSIONS = Plugin::NAMESPACE . '\\bundle-extensions\\all-extensions';
    public const POWER_EXTENSIONS = Plugin::NAMESPACE . '\\bundle-extensions\\power-extensions';

    public const ACCESS_CONTROL = Plugin::NAMESPACE . '\\bundle-extensions\\access-control';
    public const CACHING = Plugin::NAMESPACE . '\\bundle-extensions\\caching';
    public const CUSTOM_ENDPOINTS = Plugin::NAMESPACE . '\\bundle-extensions\\custom-endpoints';
    public const DEPRECATION = Plugin::NAMESPACE . '\\bundle-extensions\\deprecation';
    public const HTTP_CLIENT = Plugin::NAMESPACE . '\\bundle-extensions\\http-client';
    public const INTERNAL_GRAPHQL_SERVER = Plugin::NAMESPACE . '\\bundle-extensions\\internal-graphql-server';
    public const MULTIPLE_QUERY_EXECUTION = Plugin::NAMESPACE . '\\bundle-extensions\\multiple-query-execution';
    public const PERSISTED_QUERIES = Plugin::NAMESPACE . '\\bundle-extensions\\persisted-queries';
    public const QUERY_FUNCTIONS = Plugin::NAMESPACE . '\\bundle-extensions\\query-functions';
    public const SCHEMA_FUNCTIONS = Plugin::NAMESPACE . '\\bundle-extensions\\schema-functions';

    /**
     * @return string[]
     */
    public function getModulesToResolve(): array
    {
        return array_merge(
            // PluginStaticModuleConfiguration::displayGatoGraphQLPROBundleOnExtensionsPage() ? [
            //     self::PRO,
            // ] : [],
            PluginStaticModuleConfiguration::displayGatoGraphQLPROAllExtensionsBundleOnExtensionsPage() ? [
                // // self::ALL_EXTENSIONS,
                self::POWER_EXTENSIONS,
            ] : [],
            PluginStaticModuleConfiguration::displayGatoGraphQLPROFeatureBundlesOnExtensionsPage() ? [
                self::ACCESS_CONTROL,
                self::CACHING,
                self::CUSTOM_ENDPOINTS,
                self::DEPRECATION,
                self::HTTP_CLIENT,
                self::INTERNAL_GRAPHQL_SERVER,
                self::MULTIPLE_QUERY_EXECUTION,
                self::PERSISTED_QUERIES,
                self::QUERY_FUNCTIONS,
                self::SCHEMA_FUNCTIONS,
            ] : [],
        );
    }

    public function getName(string $module): string
    {
        $bundlePlaceholder = \__('“%s” bundle', 'gatographql');
        $extensionPlaceholder = \__('%s', 'gatographql');
        switch ($module) {
            case self::POWER_EXTENSIONS:
                return sprintf($bundlePlaceholder, \__('Power Extensions', 'gatographql'));
            case self::ACCESS_CONTROL:
                return sprintf($extensionPlaceholder, \__('Access Control', 'gatographql'));
            case self::CACHING:
                return sprintf($extensionPlaceholder, \__('Caching', 'gatographql'));
            case self::CUSTOM_ENDPOINTS:
                return sprintf($extensionPlaceholder, \__('Custom Endpoints', 'gatographql'));
            case self::DEPRECATION:
                return sprintf($extensionPlaceholder, \__('Deprecation', 'gatographql'));
            case self::HTTP_CLIENT:
                return sprintf($extensionPlaceholder, \__('HTTP Client', 'gatographql'));
            case self::INTERNAL_GRAPHQL_SERVER:
                return sprintf($extensionPlaceholder, \__('Internal GraphQL Server', 'gatographql'));
            case self::MULTIPLE_QUERY_EXECUTION:
                return sprintf($extensionPlaceholder, \__('Multiple Query Execution', 'gatographql'));
            case self::PERSISTED_QUERIES:
                return sprintf($extensionPlaceholder, \__('Persisted Queries', 'gatographql'));
            case self::QUERY_FUNCTIONS:
                return sprintf($extensionPlaceholder, \__('Query Functions', 'gatographql'));
            case self::SCHEMA_FUNCTIONS:
                return sprintf($extensionPlaceholder, \__('Schema Functions', 'gatographql'));
            default:
                return $module;
        }
    }

    public function getDescription(string $module): string
    {
        switch ($module) {
            case self::POWER_EXTENSIONS:
                return \__('All of Gato GraphQL\'s power extensions, in a single plugin', 'gatographql');
            case self::ACCESS_CONTROL:
                return \__('Define Access Control Lists to manage granular access to the API for your users', 'gatographql');
            case self::CACHING:
                return \__('Make your application faster by providing HTTP Caching for the GraphQL response, and by caching the results of expensive operations', 'gatographql');
            case self::CUSTOM_ENDPOINTS:
                return \__('Create custom schemas, with custom access rules for different users, each available under its own endpoint', 'gatographql');
            case self::DEPRECATION:
                return \__('Evolve the GraphQL schema by deprecating fields, and explaining how to replace them, through a user interface', 'gatographql');
            case self::HTTP_CLIENT:
                return \__('Connect to and interact with external services via their APIs', 'gatographql');
            case self::INTERNAL_GRAPHQL_SERVER:
                return \__('Execute GraphQL queries directly within your application, using PHP code', 'gatographql');
            case self::MULTIPLE_QUERY_EXECUTION:
                return \__('Combine multiple GraphQL queries together, and execute them as a single operation, to improve performance and make your queries more manageable', 'gatographql');
            case self::PERSISTED_QUERIES:
                return \__('Use GraphQL queries to create pre-defined endpoints as in REST, obtaining the benefits from both APIs', 'gatographql');
            case self::QUERY_FUNCTIONS:
                return \__('Manipulate the values of fields within the GraphQL query, via a collection of utilities and special directives providing meta-programming capabilities', 'gatographql');
            case self::SCHEMA_FUNCTIONS:
                return \__('Collection of fields and directives added to the GraphQL schema, providing useful functionality', 'gatographql');
            default:
                return parent::getDescription($module);
        }
    }

    public function getPriority(): int
    {
        return 30;
    }

    public function getWebsiteURL(string $module): string
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        switch ($module) {
            case self::POWER_EXTENSIONS:
                return $moduleConfiguration->getGatoGraphQLWebsiteURL();
            default:
                return parent::getWebsiteURL($module);
        }
    }

    public function getLogoURL(string $module): string
    {
        $pluginURL = PluginApp::getMainPlugin()->getPluginURL();
        switch ($module) {
            case self::POWER_EXTENSIONS:
                return $pluginURL . 'assets/img/logos/GatoGraphQL-logo-face.webp';
            case self::ACCESS_CONTROL:
                return $pluginURL . 'assets/img/extension-logos/access-control.svg';
            case self::CACHING:
                return $pluginURL . 'assets/img/extension-logos/caching.svg';
            case self::CUSTOM_ENDPOINTS:
                return $pluginURL . 'assets/img/extension-logos/custom-endpoints.svg';
            case self::DEPRECATION:
                return $pluginURL . 'assets/img/extension-logos/deprecation.svg';
            case self::HTTP_CLIENT:
                return $pluginURL . 'assets/img/extension-logos/http-client.svg';
            case self::INTERNAL_GRAPHQL_SERVER:
                return $pluginURL . 'assets/img/extension-logos/internal-graphql-server.svg';
            case self::MULTIPLE_QUERY_EXECUTION:
                return $pluginURL . 'assets/img/extension-logos/multiple-query-execution.svg';
            case self::PERSISTED_QUERIES:
                return $pluginURL . 'assets/img/extension-logos/persisted-queries.svg';
            case self::QUERY_FUNCTIONS:
                return $pluginURL . 'assets/img/extension-logos/query-functions.svg';
            case self::SCHEMA_FUNCTIONS:
                return $pluginURL . 'assets/img/extension-logos/schema-functions.svg';
            default:
                return parent::getLogoURL($module);
        }
    }

    /**
     * @return string[]
     */
    public function getBundledExtensionModules(string $module): array
    {
        switch ($module) {
            case self::POWER_EXTENSIONS:
                return [
                    PowerExtensionModuleResolver::ACCESS_CONTROL,
                    PowerExtensionModuleResolver::ACCESS_CONTROL_VISITOR_IP,
                    PowerExtensionModuleResolver::CACHE_CONTROL,
                    PowerExtensionModuleResolver::CONDITIONAL_FIELD_MANIPULATION,
                    PowerExtensionModuleResolver::CUSTOM_ENDPOINTS,
                    PowerExtensionModuleResolver::DEPRECATION_NOTIFIER,
                    PowerExtensionModuleResolver::EMAIL_SENDER,
                    PowerExtensionModuleResolver::FIELD_DEFAULT_VALUE,
                    PowerExtensionModuleResolver::FIELD_DEPRECATION,
                    PowerExtensionModuleResolver::FIELD_ON_FIELD,
                    PowerExtensionModuleResolver::FIELD_RESOLUTION_CACHING,
                    PowerExtensionModuleResolver::FIELD_RESPONSE_REMOVAL,
                    PowerExtensionModuleResolver::FIELD_TO_INPUT,
                    PowerExtensionModuleResolver::FIELD_VALUE_ITERATION_AND_MANIPULATION,
                    PowerExtensionModuleResolver::HELPER_FUNCTION_COLLECTION,
                    PowerExtensionModuleResolver::HTTP_CLIENT,
                    PowerExtensionModuleResolver::HTTP_REQUEST_VIA_SCHEMA,
                    PowerExtensionModuleResolver::INTERNAL_GRAPHQL_SERVER,
                    PowerExtensionModuleResolver::LOW_LEVEL_PERSISTED_QUERY_EDITING,
                    PowerExtensionModuleResolver::MULTIPLE_QUERY_EXECUTION,
                    PowerExtensionModuleResolver::PERSISTED_QUERIES,
                    PowerExtensionModuleResolver::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA,
                    PowerExtensionModuleResolver::PHP_FUNCTIONS_VIA_SCHEMA,
                    PowerExtensionModuleResolver::RESPONSE_ERROR_TRIGGER,
                ];
            case self::ACCESS_CONTROL:
                return [
                    PowerExtensionModuleResolver::ACCESS_CONTROL,
                    PowerExtensionModuleResolver::ACCESS_CONTROL_VISITOR_IP,
                ];
            case self::CACHING:
                return [
                    PowerExtensionModuleResolver::CACHE_CONTROL,
                    PowerExtensionModuleResolver::FIELD_RESOLUTION_CACHING,
                ];
            case self::CUSTOM_ENDPOINTS:
                return [
                    PowerExtensionModuleResolver::CUSTOM_ENDPOINTS,
                ];
            case self::DEPRECATION:
                return [
                    PowerExtensionModuleResolver::FIELD_DEPRECATION,
                    PowerExtensionModuleResolver::DEPRECATION_NOTIFIER,
                ];
            case self::HTTP_CLIENT:
                return [
                    PowerExtensionModuleResolver::HTTP_CLIENT,
                ];
            case self::INTERNAL_GRAPHQL_SERVER:
                return [
                    PowerExtensionModuleResolver::INTERNAL_GRAPHQL_SERVER,
                ];
            case self::MULTIPLE_QUERY_EXECUTION:
                return [
                    PowerExtensionModuleResolver::MULTIPLE_QUERY_EXECUTION,
                ];
            case self::PERSISTED_QUERIES:
                return [
                    PowerExtensionModuleResolver::PERSISTED_QUERIES,
                    PowerExtensionModuleResolver::LOW_LEVEL_PERSISTED_QUERY_EDITING,
                ];
            case self::QUERY_FUNCTIONS:
                return [
                    PowerExtensionModuleResolver::FIELD_TO_INPUT,
                    PowerExtensionModuleResolver::FIELD_VALUE_ITERATION_AND_MANIPULATION,
                    PowerExtensionModuleResolver::FIELD_ON_FIELD,
                    PowerExtensionModuleResolver::CONDITIONAL_FIELD_MANIPULATION,
                    PowerExtensionModuleResolver::FIELD_DEFAULT_VALUE,
                    PowerExtensionModuleResolver::FIELD_RESPONSE_REMOVAL,
                    PowerExtensionModuleResolver::RESPONSE_ERROR_TRIGGER,
                ];
            case self::SCHEMA_FUNCTIONS:
                return [
                    PowerExtensionModuleResolver::PHP_FUNCTIONS_VIA_SCHEMA,
                    PowerExtensionModuleResolver::HTTP_REQUEST_VIA_SCHEMA,
                    PowerExtensionModuleResolver::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA,
                    PowerExtensionModuleResolver::EMAIL_SENDER,
                    PowerExtensionModuleResolver::HELPER_FUNCTION_COLLECTION,
                ];
            default:
                return [];
        }
    }

    /**
     * @return string[]
     */
    public function getBundledBundleExtensionModules(string $module): array
    {
        switch ($module) {
            case self::POWER_EXTENSIONS:
                return [
                    self::ACCESS_CONTROL,
                    self::CACHING,
                    self::CUSTOM_ENDPOINTS,
                    self::DEPRECATION,
                    self::HTTP_CLIENT,
                    self::INTERNAL_GRAPHQL_SERVER,
                    self::MULTIPLE_QUERY_EXECUTION,
                    self::PERSISTED_QUERIES,
                    self::QUERY_FUNCTIONS,
                    self::SCHEMA_FUNCTIONS,
                ];
            default:
                return [];
        }
    }
}
