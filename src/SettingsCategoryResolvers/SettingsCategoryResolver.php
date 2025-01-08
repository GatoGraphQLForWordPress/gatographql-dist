<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\SettingsCategoryResolvers;

use GatoGraphQL\GatoGraphQL\Plugin;
use GatoGraphQL\GatoGraphQL\Settings\OptionNamespacerInterface;
use GatoGraphQL\GatoGraphQL\Settings\Options;

class SettingsCategoryResolver extends AbstractSettingsCategoryResolver
{
    public const ENDPOINT_CONFIGURATION = Plugin::NAMESPACE . '\endpoint-configuration';
    public const SCHEMA_CONFIGURATION = Plugin::NAMESPACE . '\schema-configuration';
    public const SCHEMA_TYPE_CONFIGURATION = Plugin::NAMESPACE . '\schema-type-configuration';
    public const SERVER_CONFIGURATION = Plugin::NAMESPACE . '\server-configuration';
    public const PLUGIN_CONFIGURATION = Plugin::NAMESPACE . '\plugin-configuration';
    public const SERVICE_CONFIGURATION = Plugin::NAMESPACE . '\service-configuration';
    public const API_KEYS = Plugin::NAMESPACE . '\api-keys';
    public const PLUGIN_MANAGEMENT = Plugin::NAMESPACE . '\plugin-management';

    /**
     * @var \GatoGraphQL\GatoGraphQL\Settings\OptionNamespacerInterface|null
     */
    private $optionNamespacer;

    final protected function getOptionNamespacer(): OptionNamespacerInterface
    {
        if ($this->optionNamespacer === null) {
            /** @var OptionNamespacerInterface */
            $optionNamespacer = $this->instanceManager->getInstance(OptionNamespacerInterface::class);
            $this->optionNamespacer = $optionNamespacer;
        }
        return $this->optionNamespacer;
    }

    /**
     * @return string[]
     */
    public function getSettingsCategoriesToResolve(): array
    {
        return [
            self::ENDPOINT_CONFIGURATION,
            self::SCHEMA_CONFIGURATION,
            self::SCHEMA_TYPE_CONFIGURATION,
            self::SERVER_CONFIGURATION,
            self::PLUGIN_CONFIGURATION,
            self::SERVICE_CONFIGURATION,
            self::API_KEYS,
            self::PLUGIN_MANAGEMENT,
        ];
    }

    public function getName(string $settingsCategory): string
    {
        switch ($settingsCategory) {
            case self::ENDPOINT_CONFIGURATION:
                return $this->__('Endpoint Configuration', 'gatographql');
            case self::SCHEMA_CONFIGURATION:
                return $this->__('Schema Configuration', 'gatographql');
            case self::SCHEMA_TYPE_CONFIGURATION:
                return $this->__('Schema Elements Configuration', 'gatographql');
            case self::SERVER_CONFIGURATION:
                return $this->__('Server Configuration', 'gatographql');
            case self::PLUGIN_CONFIGURATION:
                return $this->__('Plugin Configuration', 'gatographql');
            case self::SERVICE_CONFIGURATION:
                return $this->__('Service Configuration', 'gatographql');
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
            case self::ENDPOINT_CONFIGURATION:
                $option = Options::ENDPOINT_CONFIGURATION;
                break;
            case self::SCHEMA_CONFIGURATION:
                $option = Options::SCHEMA_CONFIGURATION;
                break;
            case self::SCHEMA_TYPE_CONFIGURATION:
                $option = Options::SCHEMA_TYPE_CONFIGURATION;
                break;
            case self::SERVER_CONFIGURATION:
                $option = Options::SERVER_CONFIGURATION;
                break;
            case self::PLUGIN_CONFIGURATION:
                $option = Options::PLUGIN_CONFIGURATION;
                break;
            case self::SERVICE_CONFIGURATION:
                $option = Options::SERVICE_CONFIGURATION;
                break;
            case self::API_KEYS:
                $option = Options::API_KEYS;
                break;
            case self::PLUGIN_MANAGEMENT:
                $option = Options::PLUGIN_MANAGEMENT;
                break;
            default:
                $option = parent::getDBOptionName($settingsCategory);
                break;
        }
        return $this->getOptionNamespacer()->namespaceOption($option);
    }

    public function getPriority(string $settingsCategory): int
    {
        switch ($settingsCategory) {
            case self::ENDPOINT_CONFIGURATION:
                return 100;
            case self::SCHEMA_CONFIGURATION:
                return 90;
            case self::SCHEMA_TYPE_CONFIGURATION:
                return 80;
            case self::SERVER_CONFIGURATION:
                return 70;
            case self::PLUGIN_CONFIGURATION:
                return 60;
            case self::SERVICE_CONFIGURATION:
                return 50;
            case self::API_KEYS:
                return 40;
            case self::PLUGIN_MANAGEMENT:
                return 30;
            default:
                return parent::getPriority($settingsCategory);
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
