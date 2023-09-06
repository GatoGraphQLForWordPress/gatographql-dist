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
    public function getBundledExtensionSlugs(string $module): array
    {
        switch ($module) {
            case self::ALL_EXTENSIONS:
                return [
                    'access-control',
                    'access-control-visitor-ip',
                    'automation',
                    'cache-control',
                    'conditional-field-manipulation',
                    'deprecation-notifier',
                    'email-sender',
                    'events-manager',
                    'field-default-value',
                    'field-deprecation',
                    'field-on-field',
                    'field-resolution-caching',
                    'field-response-removal',
                    'field-to-input',
                    'field-value-iteration-and-manipulation',
                    'google-translate',
                    'helper-function-collection',
                    'http-client',
                    'http-request-via-schema',
                    'internal-graphql-server',
                    'low-level-persisted-query-editing',
                    'multiple-query-execution',
                    'php-constants-and-environment-variables-via-schema',
                    'php-functions-via-schema',
                    'response-error-trigger',
                    'schema-editing-access',
                ];
            case self::APPLICATION_GLUE_AND_AUTOMATOR:
                return [
                    'automation',
                    'conditional-field-manipulation',
                    'email-sender',
                    'field-default-value',
                    'field-on-field',
                    'field-resolution-caching',
                    'field-response-removal',
                    'field-to-input',
                    'field-value-iteration-and-manipulation',
                    'helper-function-collection',
                    'http-client',
                    'http-request-via-schema',
                    'internal-graphql-server',
                    'multiple-query-execution',
                    'php-constants-and-environment-variables-via-schema',
                    'php-functions-via-schema',
                    'response-error-trigger',
                ];
            case self::CONTENT_TRANSLATION:
                return [
                    'conditional-field-manipulation',
                    'field-on-field',
                    'field-response-removal',
                    'field-to-input',
                    'field-value-iteration-and-manipulation',
                    'google-translate',
                    'multiple-query-execution',
                    'php-functions-via-schema',
                ];
            case self::PUBLIC_API:
                return [
                    'access-control',
                    'access-control-visitor-ip',
                    'cache-control',
                    'conditional-field-manipulation',
                    'deprecation-notifier',
                    'field-default-value',
                    'field-deprecation',
                    'field-to-input',
                    'field-value-iteration-and-manipulation',
                    'low-level-persisted-query-editing',
                    'multiple-query-execution',
                    'response-error-trigger',
                    'schema-editing-access',
                ];
            default:
                return [];
        }
    }

    /**
     * @return string[]
     */
    public function getBundledBundleExtensionSlugs(string $module): array
    {
        switch ($module) {
            case self::ALL_EXTENSIONS:
                return array_map(
                    \Closure::fromCallable([$this, 'getSlug']),
                    array_diff(
                        $this->getModulesToResolve(),
                        [$module]
                    )
                );
            default:
                return [];
        }
    }
}
