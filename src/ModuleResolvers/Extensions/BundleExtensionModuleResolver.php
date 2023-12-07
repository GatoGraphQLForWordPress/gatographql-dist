<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers\Extensions;

use GatoGraphQL\GatoGraphQL\Plugin;
use GatoGraphQL\GatoGraphQL\PluginApp;

class BundleExtensionModuleResolver extends AbstractBundleExtensionModuleResolver
{
    public const ALL_EXTENSIONS = Plugin::NAMESPACE . '\\bundle-extensions\\all-extensions';
    public const APPLICATION_GLUE_AND_AUTOMATOR = Plugin::NAMESPACE . '\\bundle-extensions\\application-glue-and-automator';
    public const CONTENT_TRANSLATION = Plugin::NAMESPACE . '\\bundle-extensions\\content-translation';
    public const PUBLIC_API = Plugin::NAMESPACE . '\\bundle-extensions\\public-api';

    /**
     * @return string[]
     */
    public function getModulesToResolve(): array
    {
        return [
            self::ALL_EXTENSIONS,
            self::APPLICATION_GLUE_AND_AUTOMATOR,
            self::CONTENT_TRANSLATION,
            self::PUBLIC_API,
        ];
    }

    public function getName(string $module): string
    {
        $placeholder = \__('“%s” Bundle', 'gatographql');
        switch ($module) {
            case self::ALL_EXTENSIONS:
                return sprintf($placeholder, \__('All Extensions', 'gatographql'));
            case self::APPLICATION_GLUE_AND_AUTOMATOR:
                return sprintf($placeholder, \__('Application Glue & Automator', 'gatographql'));
            case self::CONTENT_TRANSLATION:
                return sprintf($placeholder, \__('Content Translation', 'gatographql'));
            case self::PUBLIC_API:
                return sprintf($placeholder, \__('Public API', 'gatographql'));
            default:
                return $module;
        }
    }

    public function getDescription(string $module): string
    {
        switch ($module) {
            case self::ALL_EXTENSIONS:
                return \__('All of Gato GraphQL extensions, in a single plugin. As new extensions are created and released, they will also be added to this bundle.', 'gatographql');
            case self::APPLICATION_GLUE_AND_AUTOMATOR:
                return \__('Keep content in sync, help migrate websites, send notifications, interact with 3rd-party services and APIs, create automation workflows, and more.', 'gatographql');
            case self::CONTENT_TRANSLATION:
                return \__('Translate content via the Google Translate API, even within the deep structure of (Gutenberg) blocks.', 'gatographql');
            case self::PUBLIC_API:
                return \__('Expose your public APIs in a secure manner, make them faster through caching, leverage tools to access data, and evolve the schema.', 'gatographql');
            default:
                return parent::getDescription($module);
        }
    }

    public function getPriority(): int
    {
        return 20;
    }

    public function getLogoURL(string $module): string
    {
        switch ($module) {
            case self::ALL_EXTENSIONS:
                return PluginApp::getMainPlugin()->getPluginURL() . 'assets/img/logos/GatoGraphQL-logo-face.png';
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
            case self::ALL_EXTENSIONS:
                return [
                    ExtensionModuleResolver::ACCESS_CONTROL,
                    ExtensionModuleResolver::ACCESS_CONTROL_VISITOR_IP,
                    ExtensionModuleResolver::AUTOMATION,
                    ExtensionModuleResolver::CACHE_CONTROL,
                    ExtensionModuleResolver::CONDITIONAL_FIELD_MANIPULATION,
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
                    ExtensionModuleResolver::MULTIPLE_QUERY_EXECUTION,
                    ExtensionModuleResolver::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA,
                    ExtensionModuleResolver::PHP_FUNCTIONS_VIA_SCHEMA,
                    ExtensionModuleResolver::RESPONSE_ERROR_TRIGGER,
                    ExtensionModuleResolver::SCHEMA_EDITING_ACCESS,
                ];
            case self::APPLICATION_GLUE_AND_AUTOMATOR:
                return [
                    ExtensionModuleResolver::AUTOMATION,
                    ExtensionModuleResolver::CONDITIONAL_FIELD_MANIPULATION,
                    ExtensionModuleResolver::EMAIL_SENDER,
                    ExtensionModuleResolver::FIELD_DEFAULT_VALUE,
                    ExtensionModuleResolver::FIELD_ON_FIELD,
                    ExtensionModuleResolver::FIELD_RESOLUTION_CACHING,
                    ExtensionModuleResolver::FIELD_RESPONSE_REMOVAL,
                    ExtensionModuleResolver::FIELD_TO_INPUT,
                    ExtensionModuleResolver::FIELD_VALUE_ITERATION_AND_MANIPULATION,
                    ExtensionModuleResolver::HELPER_FUNCTION_COLLECTION,
                    ExtensionModuleResolver::HTTP_CLIENT,
                    ExtensionModuleResolver::HTTP_REQUEST_VIA_SCHEMA,
                    ExtensionModuleResolver::INTERNAL_GRAPHQL_SERVER,
                    ExtensionModuleResolver::MULTIPLE_QUERY_EXECUTION,
                    ExtensionModuleResolver::PHP_CONSTANTS_AND_ENVIRONMENT_VARIABLES_VIA_SCHEMA,
                    ExtensionModuleResolver::PHP_FUNCTIONS_VIA_SCHEMA,
                    ExtensionModuleResolver::RESPONSE_ERROR_TRIGGER,
                ];
            case self::CONTENT_TRANSLATION:
                return [
                    ExtensionModuleResolver::CONDITIONAL_FIELD_MANIPULATION,
                    ExtensionModuleResolver::FIELD_ON_FIELD,
                    ExtensionModuleResolver::FIELD_RESPONSE_REMOVAL,
                    ExtensionModuleResolver::FIELD_TO_INPUT,
                    ExtensionModuleResolver::FIELD_VALUE_ITERATION_AND_MANIPULATION,
                    ExtensionModuleResolver::GOOGLE_TRANSLATE,
                    ExtensionModuleResolver::MULTIPLE_QUERY_EXECUTION,
                    ExtensionModuleResolver::PHP_FUNCTIONS_VIA_SCHEMA,
                ];
            case self::PUBLIC_API:
                return [
                    ExtensionModuleResolver::ACCESS_CONTROL,
                    ExtensionModuleResolver::ACCESS_CONTROL_VISITOR_IP,
                    ExtensionModuleResolver::CACHE_CONTROL,
                    ExtensionModuleResolver::CONDITIONAL_FIELD_MANIPULATION,
                    ExtensionModuleResolver::DEPRECATION_NOTIFIER,
                    ExtensionModuleResolver::FIELD_DEFAULT_VALUE,
                    ExtensionModuleResolver::FIELD_DEPRECATION,
                    ExtensionModuleResolver::FIELD_TO_INPUT,
                    ExtensionModuleResolver::FIELD_VALUE_ITERATION_AND_MANIPULATION,
                    ExtensionModuleResolver::LOW_LEVEL_PERSISTED_QUERY_EDITING,
                    ExtensionModuleResolver::MULTIPLE_QUERY_EXECUTION,
                    ExtensionModuleResolver::RESPONSE_ERROR_TRIGGER,
                    ExtensionModuleResolver::SCHEMA_EDITING_ACCESS,
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
            case self::ALL_EXTENSIONS:
                return array_diff(
                    $this->getModulesToResolve(),
                    [$module]
                );
            default:
                return [];
        }
    }
}
