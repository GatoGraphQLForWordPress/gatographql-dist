<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Services\ModuleTypeResolvers;

use GatoGraphQL\GatoGraphQL\Plugin;

/**
 * All module types used in this plugin. Others can be registered by extensions
 */
class ModuleTypeResolver extends AbstractModuleTypeResolver
{
    public const CLIENT = Plugin::NAMESPACE . '\client';
    public const ENDPOINT = Plugin::NAMESPACE . '\endpoint';
    public const ENDPOINT_CONFIGURATION = Plugin::NAMESPACE . '\endpoint-configuration';
    public const FUNCTIONALITY = Plugin::NAMESPACE . '\functionality';
    public const INTEGRATIONS = Plugin::NAMESPACE . '\integrations';
    public const OPERATIONAL = Plugin::NAMESPACE . '\operational';
    public const PERFORMANCE = Plugin::NAMESPACE . '\performance';
    public const PLUGIN_GENERAL_SETTINGS = Plugin::NAMESPACE . '\plugin-general-settings';
    public const PLUGIN_MANAGEMENT = Plugin::NAMESPACE . '\plugin-management';
    public const SCHEMA_CONFIGURATION = Plugin::NAMESPACE . '\schema-configuration';
    public const SERVER = Plugin::NAMESPACE . '\server';
    public const SCHEMA_TYPE = Plugin::NAMESPACE . '\schema-type';
    public const SCHEMA_DIRECTIVE = Plugin::NAMESPACE . '\schema-directive';
    public const USER_INTERFACE = Plugin::NAMESPACE . '\user-interface';
    public const VERSIONING = Plugin::NAMESPACE . '\versioning';

    /**
     * These are a special type, used to display extensions
     */
    public const EXTENSION = Plugin::NAMESPACE . '\extension';
    public const BUNDLE_EXTENSION = Plugin::NAMESPACE . '\bundle-extension';

    /**
     * @return string[]
     */
    public function getModuleTypesToResolve(): array
    {
        return [
            self::CLIENT,
            self::ENDPOINT,
            self::ENDPOINT_CONFIGURATION,
            self::FUNCTIONALITY,
            self::INTEGRATIONS,
            self::OPERATIONAL,
            self::PERFORMANCE,
            self::PLUGIN_GENERAL_SETTINGS,
            self::PLUGIN_MANAGEMENT,
            self::SCHEMA_CONFIGURATION,
            self::SERVER,
            self::SCHEMA_TYPE,
            self::SCHEMA_DIRECTIVE,
            self::USER_INTERFACE,
            self::VERSIONING,
            self::EXTENSION,
            self::BUNDLE_EXTENSION,
        ];
    }

    public function getName(string $moduleType): string
    {
        switch ($moduleType) {
            case self::CLIENT:
                return $this->__('Client', 'gatographql');
            case self::ENDPOINT:
                return $this->__('Endpoint', 'gatographql');
            case self::ENDPOINT_CONFIGURATION:
                return $this->__('Endpoint Configuration', 'gatographql');
            case self::FUNCTIONALITY:
                return $this->__('Functionality', 'gatographql');
            case self::INTEGRATIONS:
                return $this->__('Integrations', 'gatographql');
            case self::OPERATIONAL:
                return $this->__('Operational', 'gatographql');
            case self::PERFORMANCE:
                return $this->__('Performance', 'gatographql');
            case self::PLUGIN_GENERAL_SETTINGS:
                return $this->__('General Settings', 'gatographql');
            case self::PLUGIN_MANAGEMENT:
                return $this->__('Plugin Management', 'gatographql');
            case self::SCHEMA_CONFIGURATION:
                return $this->__('Schema Configuration', 'gatographql');
            case self::SERVER:
                return $this->__('Server', 'gatographql');
            case self::SCHEMA_TYPE:
                return $this->__('Schema Type', 'gatographql');
            case self::SCHEMA_DIRECTIVE:
                return $this->__('Schema Directive', 'gatographql');
            case self::USER_INTERFACE:
                return $this->__('User Interface', 'gatographql');
            case self::VERSIONING:
                return $this->__('Versioning', 'gatographql');
            case self::EXTENSION:
                return $this->__('Extensions', 'gatographql');
            case self::BUNDLE_EXTENSION:
                return $this->__('Bundle Extensions', 'gatographql');
            default:
                return '';
        }
    }

    public function isHidden(string $moduleType): bool
    {
        switch ($moduleType) {
            case self::EXTENSION:
            case self::BUNDLE_EXTENSION:
                return true;
            default:
                return parent::isHidden($moduleType);
        }
    }
}
