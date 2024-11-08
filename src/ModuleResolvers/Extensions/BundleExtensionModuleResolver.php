<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers\Extensions;

use GatoGraphQL\GatoGraphQL\App;
use GatoGraphQL\GatoGraphQL\Module;
use GatoGraphQL\GatoGraphQL\ModuleConfiguration;
use GatoGraphQL\GatoGraphQL\Plugin;
use GatoGraphQL\GatoGraphQL\PluginApp;
use GatoGraphQL\GatoGraphQL\PluginStaticModuleConfiguration;

class BundleExtensionModuleResolver extends AbstractBundleExtensionModuleResolver
{
    public const PRO = Plugin::NAMESPACE . '\\bundle-extensions\\pro';

    public const ALL_EXTENSIONS = Plugin::NAMESPACE . '\\bundle-extensions\\all-extensions';

    public const ACCESS_CONTROL = Plugin::NAMESPACE . '\\bundle-extensions\\access-control';
    public const CACHING = Plugin::NAMESPACE . '\\bundle-extensions\\caching';
    public const CUSTOM_ENDPOINTS = Plugin::NAMESPACE . '\\bundle-extensions\\custom-endpoints';
    public const DEPRECATION = Plugin::NAMESPACE . '\\bundle-extensions\\deprecation';
    public const INTERNAL_GRAPHQL_SERVER = Plugin::NAMESPACE . '\\bundle-extensions\\internal-graphql-server';
    public const MULTIPLE_QUERY_EXECUTION = Plugin::NAMESPACE . '\\bundle-extensions\\multiple-query-execution';
    public const PERSISTED_QUERIES = Plugin::NAMESPACE . '\\bundle-extensions\\persisted-queries';
    public const POLYLANG_INTEGRATION = Plugin::NAMESPACE . '\\bundle-extensions\\polylang-integration';
    public const QUERY_FUNCTIONS = Plugin::NAMESPACE . '\\bundle-extensions\\query-functions';
    public const SCHEMA_FUNCTIONS = Plugin::NAMESPACE . '\\bundle-extensions\\schema-functions';

    /**
     * @return string[]
     */
    public function getModulesToResolve(): array
    {
        return array_merge(
            PluginStaticModuleConfiguration::displayGatoGraphQLPROBundleOnExtensionsPage() ? [
                self::PRO,
            ] : [],
            PluginStaticModuleConfiguration::displayGatoGraphQLPROFeatureBundlesOnExtensionsPage() ? [
                self::ACCESS_CONTROL,
                self::CACHING,
                self::CUSTOM_ENDPOINTS,
                self::DEPRECATION,
                self::INTERNAL_GRAPHQL_SERVER,
                self::MULTIPLE_QUERY_EXECUTION,
                self::PERSISTED_QUERIES,
                self::POLYLANG_INTEGRATION,
                self::QUERY_FUNCTIONS,
                self::SCHEMA_FUNCTIONS,
            ] : [],
            PluginStaticModuleConfiguration::displayGatoGraphQLPROAllExtensionsBundleOnExtensionsPage() ? [
                self::ALL_EXTENSIONS,
            ] : [],
        );
    }

    public function getName(string $module): string
    {
        $bundlePlaceholder = \__('“%s” bundle', 'gatographql');
        $extensionPlaceholder = \__('%s', 'gatographql');
        switch ($module) {
            case self::PRO:
                return \__('Gato GraphQL PRO', 'gatographql');
            case self::ALL_EXTENSIONS:
                return sprintf($bundlePlaceholder, \__('All Extensions', 'gatographql'));
            case self::ACCESS_CONTROL:
                return sprintf($extensionPlaceholder, \__('Access Control', 'gatographql'));
            case self::CACHING:
                return sprintf($extensionPlaceholder, \__('Caching', 'gatographql'));
            case self::CUSTOM_ENDPOINTS:
                return sprintf($extensionPlaceholder, \__('Custom Endpoints', 'gatographql'));
            case self::DEPRECATION:
                return sprintf($extensionPlaceholder, \__('Deprecation', 'gatographql'));
            case self::INTERNAL_GRAPHQL_SERVER:
                return sprintf($extensionPlaceholder, \__('Internal GraphQL Server', 'gatographql'));
            case self::MULTIPLE_QUERY_EXECUTION:
                return sprintf($extensionPlaceholder, \__('Multiple Query Execution', 'gatographql'));
            case self::PERSISTED_QUERIES:
                return sprintf($extensionPlaceholder, \__('Persisted Queries', 'gatographql'));
            case self::POLYLANG_INTEGRATION:
                return sprintf($extensionPlaceholder, \__('Polylang Integration', 'gatographql'));
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
            case self::PRO:
                return \__('All the PRO extensions for Gato GraphQL, the most powerful GraphQL server for WordPress', 'gatographql');
            case self::ALL_EXTENSIONS:
                return \__('All of Gato GraphQL extensions, in a single plugin', 'gatographql');
            case self::ACCESS_CONTROL:
                return \__('Define Access Control Lists to manage granular access to the API for your users', 'gatographql');
            case self::CACHING:
                return \__('Make your application faster by providing HTTP Caching for the GraphQL response, and by caching the results of expensive operations', 'gatographql');
            case self::CUSTOM_ENDPOINTS:
                return \__('Create custom schemas, with custom access rules for different users, each available under its own endpoint', 'gatographql');
            case self::DEPRECATION:
                return \__('Evolve the GraphQL schema by deprecating fields, and explaining how to replace them, through a user interface', 'gatographql');
            case self::INTERNAL_GRAPHQL_SERVER:
                return \__('Execute GraphQL queries directly within your application, using PHP code', 'gatographql');
            case self::MULTIPLE_QUERY_EXECUTION:
                return \__('Combine multiple GraphQL queries together, and execute them as a single operation, to improve performance and make your queries more manageable', 'gatographql');
            case self::PERSISTED_QUERIES:
                return \__('Use GraphQL queries to create pre-defined endpoints as in REST, obtaining the benefits from both APIs', 'gatographql');
            case self::POLYLANG_INTEGRATION:
                return \__('Integration with the Polylang plugin, providing fields to the GraphQL schema to fetch multilingual data', 'gatographql');
            case self::QUERY_FUNCTIONS:
                return \__('Manipulate the values of fields within the GraphQL query, via a collection of utilities and special directives providing meta-programming capabilities', 'gatographql');
            case self::SCHEMA_FUNCTIONS:
                return \__('Collection of fields and directives added to the GraphQL schema, providing useful functionality concerning sending emails, manipulating strings, connecting to external APIs, and others', 'gatographql');
            default:
                return parent::getDescription($module);
        }
    }

    public function getPriority(): int
    {
        return 20;
    }

    public function getWebsiteURL(string $module): string
    {
        /** @var ModuleConfiguration */
        $moduleConfiguration = App::getModule(Module::class)->getConfiguration();
        switch ($module) {
            case self::PRO:
            case self::ALL_EXTENSIONS:
                return $moduleConfiguration->getGatoGraphQLWebsiteURL();
            default:
                return parent::getWebsiteURL($module);
        }
    }

    public function getLogoURL(string $module): string
    {
        $pluginURL = PluginApp::getMainPlugin()->getPluginURL();
        switch ($module) {
            case self::PRO:
            case self::ALL_EXTENSIONS:
                return $pluginURL . 'assets/img/logos/GatoGraphQL-logo-face.png';
            case self::ACCESS_CONTROL:
                return $pluginURL . 'assets/img/extension-logos/access-control.svg';
            case self::CACHING:
                return $pluginURL . 'assets/img/extension-logos/caching.svg';
            case self::CUSTOM_ENDPOINTS:
                return $pluginURL . 'assets/img/extension-logos/custom-endpoints.svg';
            case self::DEPRECATION:
                return $pluginURL . 'assets/img/extension-logos/deprecation.svg';
            case self::INTERNAL_GRAPHQL_SERVER:
                return $pluginURL . 'assets/img/extension-logos/internal-graphql-server.svg';
            case self::MULTIPLE_QUERY_EXECUTION:
                return $pluginURL . 'assets/img/extension-logos/multiple-query-execution.svg';
            case self::PERSISTED_QUERIES:
                return $pluginURL . 'assets/img/extension-logos/persisted-queries.svg';
            case self::POLYLANG_INTEGRATION:
                return $pluginURL . 'assets/img/extension-logos/polylang-integration.png';
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
            case self::PRO:
                return [
                    ExtensionModuleResolver::ACCESS_CONTROL,
                    ExtensionModuleResolver::ACCESS_CONTROL_VISITOR_IP,
                    ExtensionModuleResolver::AUTOMATION,
                    ExtensionModuleResolver::CACHE_CONTROL,
                    ExtensionModuleResolver::CONDITIONAL_FIELD_MANIPULATION,
                    ExtensionModuleResolver::CUSTOM_ENDPOINTS,
                    ExtensionModuleResolver::DEPRECATION_NOTIFIER,
                    ExtensionModuleResolver::EMAIL_SENDER,
                    ExtensionModuleResolver::EVENTS_MANAGER,
                    ExtensionModuleResolver::FIELD_DEFAULT_VALUE,
                    ExtensionModuleResolver::FIELD_DEPRECATION,
                    ExtensionModuleResolver::FIELD_ON_FIELD,
                    ExtensionModuleResolver::FIELD_RESOLUTION_CACHING,
                    ExtensionModuleResolver::FIELD_RESPONSE_REMOVAL,
                    ExtensionModuleResolver::FIELD_TO_INPUT,
                    ExtensionModuleResolver::FIELD_VALUE_ITERATION_AND_MANIPULATION,
                    ExtensionModuleResolver::GOOGLE_TRANSLATE,
                    ExtensionModuleResolver::HELPER_FUNCTION_COLLECTION,
                    ExtensionModuleResolver::HTTP_CLIENT,
                    ExtensionModuleResolver::HTTP_REQUEST_VIA_SCHEMA,
                    ExtensionModuleResolver::INTERNAL_GRAPHQL_SERVER,
                    ExtensionModuleResolver::LOW_LEVEL_PERSISTED_QUERY_EDITING,
                    ExtensionModuleResolver::MULTILINGUALPRESS,
                    ExtensionModuleResolver::MULTIPLE_QUERY_EXECUTION,
                    ExtensionModuleResolver::PERSISTED_QUERIES,
                    ExtensionModuleResolver::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA,
                    ExtensionModuleResolver::PHP_FUNCTIONS_VIA_SCHEMA,
                    ExtensionModuleResolver::POLYLANG,
                    ExtensionModuleResolver::RESPONSE_ERROR_TRIGGER,
                ];
            case self::ALL_EXTENSIONS:
                return [
                    ExtensionModuleResolver::ACCESS_CONTROL,
                    ExtensionModuleResolver::ACCESS_CONTROL_VISITOR_IP,
                    // ExtensionModuleResolver::AUTOMATION,
                    ExtensionModuleResolver::CACHE_CONTROL,
                    ExtensionModuleResolver::CONDITIONAL_FIELD_MANIPULATION,
                    ExtensionModuleResolver::CUSTOM_ENDPOINTS,
                    ExtensionModuleResolver::DEPRECATION_NOTIFIER,
                    ExtensionModuleResolver::EMAIL_SENDER,
                    // ExtensionModuleResolver::EVENTS_MANAGER,
                    ExtensionModuleResolver::FIELD_DEFAULT_VALUE,
                    ExtensionModuleResolver::FIELD_DEPRECATION,
                    ExtensionModuleResolver::FIELD_ON_FIELD,
                    ExtensionModuleResolver::FIELD_RESOLUTION_CACHING,
                    ExtensionModuleResolver::FIELD_RESPONSE_REMOVAL,
                    ExtensionModuleResolver::FIELD_TO_INPUT,
                    ExtensionModuleResolver::FIELD_VALUE_ITERATION_AND_MANIPULATION,
                    // ExtensionModuleResolver::GOOGLE_TRANSLATE,
                    ExtensionModuleResolver::HELPER_FUNCTION_COLLECTION,
                    ExtensionModuleResolver::HTTP_CLIENT,
                    ExtensionModuleResolver::HTTP_REQUEST_VIA_SCHEMA,
                    ExtensionModuleResolver::INTERNAL_GRAPHQL_SERVER,
                    ExtensionModuleResolver::LOW_LEVEL_PERSISTED_QUERY_EDITING,
                    // ExtensionModuleResolver::MULTILINGUALPRESS,
                    ExtensionModuleResolver::MULTIPLE_QUERY_EXECUTION,
                    ExtensionModuleResolver::PERSISTED_QUERIES,
                    ExtensionModuleResolver::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA,
                    ExtensionModuleResolver::PHP_FUNCTIONS_VIA_SCHEMA,
                    ExtensionModuleResolver::POLYLANG,
                    ExtensionModuleResolver::RESPONSE_ERROR_TRIGGER,
                ];
            case self::ACCESS_CONTROL:
                return [
                    ExtensionModuleResolver::ACCESS_CONTROL,
                    ExtensionModuleResolver::ACCESS_CONTROL_VISITOR_IP,
                ];
            case self::CACHING:
                return [
                    ExtensionModuleResolver::CACHE_CONTROL,
                    ExtensionModuleResolver::FIELD_RESOLUTION_CACHING,
                ];
            case self::CUSTOM_ENDPOINTS:
                return [
                    ExtensionModuleResolver::CUSTOM_ENDPOINTS,
                ];
            case self::DEPRECATION:
                return [
                    ExtensionModuleResolver::FIELD_DEPRECATION,
                    ExtensionModuleResolver::DEPRECATION_NOTIFIER,
                ];
            case self::INTERNAL_GRAPHQL_SERVER:
                return [
                    ExtensionModuleResolver::INTERNAL_GRAPHQL_SERVER,
                ];
            case self::MULTIPLE_QUERY_EXECUTION:
                return [
                    ExtensionModuleResolver::MULTIPLE_QUERY_EXECUTION,
                ];
            case self::PERSISTED_QUERIES:
                return [
                    ExtensionModuleResolver::PERSISTED_QUERIES,
                    ExtensionModuleResolver::LOW_LEVEL_PERSISTED_QUERY_EDITING,
                ];
            case self::POLYLANG_INTEGRATION:
                return [
                    ExtensionModuleResolver::POLYLANG,
                ];
            case self::QUERY_FUNCTIONS:
                return [
                    ExtensionModuleResolver::FIELD_TO_INPUT,
                    ExtensionModuleResolver::FIELD_VALUE_ITERATION_AND_MANIPULATION,
                    ExtensionModuleResolver::FIELD_ON_FIELD,
                    ExtensionModuleResolver::CONDITIONAL_FIELD_MANIPULATION,
                    ExtensionModuleResolver::FIELD_DEFAULT_VALUE,
                    ExtensionModuleResolver::FIELD_RESPONSE_REMOVAL,
                    ExtensionModuleResolver::RESPONSE_ERROR_TRIGGER,
                ];
            case self::SCHEMA_FUNCTIONS:
                return [
                    ExtensionModuleResolver::HTTP_CLIENT,
                    ExtensionModuleResolver::PHP_FUNCTIONS_VIA_SCHEMA,
                    ExtensionModuleResolver::HTTP_REQUEST_VIA_SCHEMA,
                    ExtensionModuleResolver::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA,
                    ExtensionModuleResolver::EMAIL_SENDER,
                    ExtensionModuleResolver::HELPER_FUNCTION_COLLECTION,
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
            case self::PRO:
                return array_diff(
                    $this->getModulesToResolve(),
                    [$module]
                );
            case self::ALL_EXTENSIONS:
                return [
                    self::ACCESS_CONTROL,
                    self::CACHING,
                    self::CUSTOM_ENDPOINTS,
                    self::DEPRECATION,
                    self::INTERNAL_GRAPHQL_SERVER,
                    self::MULTIPLE_QUERY_EXECUTION,
                    self::PERSISTED_QUERIES,
                    self::POLYLANG_INTEGRATION,
                    self::QUERY_FUNCTIONS,
                    self::SCHEMA_FUNCTIONS,
                ];
            default:
                return [];
        }
    }
}
