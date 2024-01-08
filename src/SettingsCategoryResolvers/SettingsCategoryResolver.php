<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\SettingsCategoryResolvers;

use GatoGraphQL\GatoGraphQL\Plugin;
use GatoGraphQL\GatoGraphQL\Settings\Options;

class SettingsCategoryResolver extends AbstractSettingsCategoryResolver
{
    public const SCHEMA_CONFIGURATION = Plugin::NAMESPACE . '\schema-configuration';
    public const ENDPOINT_CONFIGURATION = Plugin::NAMESPACE . '\endpoint-configuration';
    public const SERVER_CONFIGURATION = Plugin::NAMESPACE . '\server-configuration';
    public const PLUGIN_CONFIGURATION = Plugin::NAMESPACE . '\plugin-configuration';
    public const API_KEYS = Plugin::NAMESPACE . '\api-keys';
    public const PLUGIN_MANAGEMENT = Plugin::NAMESPACE . '\plugin-management';

    /**
     * @return string[]
     */
    public function getSettingsCategoriesToResolve(): array
    {
        return [
            self::SCHEMA_CONFIGURATION,
            self::ENDPOINT_CONFIGURATION,
            self::SERVER_CONFIGURATION,
            self::PLUGIN_CONFIGURATION,
            self::API_KEYS,
            self::PLUGIN_MANAGEMENT,
        ];
    }

    public function getName(string $settingsCategory): string
    {
        switch ($settingsCategory) {
            case self::SCHEMA_CONFIGURATION:
                return $this->__('Schema Configuration', 'gatographql');
            case self::ENDPOINT_CONFIGURATION:
                return $this->__('Endpoint Configuration', 'gatographql');
            case self::SERVER_CONFIGURATION:
                return $this->__('Server Configuration', 'gatographql');
            case self::PLUGIN_CONFIGURATION:
                return $this->__('Plugin Configuration', 'gatographql');
            case self::API_KEYS:
                return $this->__('API Keys', 'gatographql');
            case self::PLUGIN_MANAGEMENT:
                return $this->__('Plugin Management', 'gatographql');
            default:
                return parent::getName($settingsCategory);
        }
    }

    public function getDBOptionName(string $settingsCategory): string
    {
        switch ($settingsCategory) {
            case self::SCHEMA_CONFIGURATION:
                return Options::SCHEMA_CONFIGURATION;
            case self::ENDPOINT_CONFIGURATION:
                return Options::ENDPOINT_CONFIGURATION;
            case self::SERVER_CONFIGURATION:
                return Options::SERVER_CONFIGURATION;
            case self::PLUGIN_CONFIGURATION:
                return Options::PLUGIN_CONFIGURATION;
            case self::API_KEYS:
                return Options::API_KEYS;
            case self::PLUGIN_MANAGEMENT:
                return Options::PLUGIN_MANAGEMENT;
            default:
                return parent::getDBOptionName($settingsCategory);
        }
    }

    public function addOptionsFormSubmitButton(string $settingsCategory): bool
    {
        switch ($settingsCategory) {
            case self::PLUGIN_MANAGEMENT:
                return false;
            default:
                return parent::addOptionsFormSubmitButton($settingsCategory);
        }
    }
}
