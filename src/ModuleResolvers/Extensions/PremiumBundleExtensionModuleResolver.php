<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers\Extensions;

use GatoGraphQL\GatoGraphQL\Plugin;
use GatoGraphQL\GatoGraphQL\PluginApp;
use GatoGraphQL\GatoGraphQL\PluginStaticModuleConfiguration;

class PremiumBundleExtensionModuleResolver extends AbstractBundleExtensionModuleResolver
{
    use PremiumExtensionModuleResolverTrait;

    public const AUTOMATION = Plugin::NAMESPACE . '\\bundle-extensions\\automation';
    public const EVENTS_MANAGER = Plugin::NAMESPACE . '\\bundle-extensions\\events-manager';
    public const MULTILINGUALPRESS = Plugin::NAMESPACE . '\\bundle-extensions\\multilingualpress';
    public const POLYLANG = Plugin::NAMESPACE . '\\bundle-extensions\\polylang';
    public const TRANSLATION = Plugin::NAMESPACE . '\\bundle-extensions\\translation';

    /**
     * @return string[]
     */
    public function getModulesToResolve(): array
    {
        if (!PluginStaticModuleConfiguration::displayGatoGraphQLPROFeatureBundlesOnExtensionsPage()) {
            return [];
        }
        return [
            self::AUTOMATION,
            self::EVENTS_MANAGER,
            self::MULTILINGUALPRESS,
            self::POLYLANG,
            self::TRANSLATION,
        ];
    }

    public function getName(string $module): string
    {
        switch ($module) {
            case self::AUTOMATION:
                return \__('Automation', 'gatographql');
            case self::EVENTS_MANAGER:
                return \__('Events Manager', 'gatographql');
            case self::MULTILINGUALPRESS:
                return \__('MultilingualPress', 'gatographql');
            case self::POLYLANG:
                return \__('Polylang', 'gatographql');
            case self::TRANSLATION:
                return \__('Translation', 'gatographql');
            default:
                return $module;
        }
    }

    public function getDescription(string $module): string
    {
        switch ($module) {
            case self::AUTOMATION:
                return \__('Use GraphQL to automate tasks in your app: Execute queries when some event happens, chain queries, and schedule and trigger queries via WP-Cron. (The Internal GraphQL Server extension is required).', 'gatographql');
            case self::EVENTS_MANAGER:
                return \__('Integration with plugin "Events Manager", adding fields to the schema to fetch event data.', 'gatographql');
            case self::MULTILINGUALPRESS:
                return \__('Integration with plugin "MultilingualPress", adding fields to the schema to fetch multilingual data.', 'gatographql');
            case self::POLYLANG:
                return \__('Integration with plugin "Polylang", adding fields to the schema to fetch multilingual data.', 'gatographql');
            case self::TRANSLATION:
                return \__('Translate content to multiple languages using the service provider of your choice, among ChatGPT, Claude, DeepL, and Google Translate.', 'gatographql');
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
        $pluginURL = PluginApp::getMainPlugin()->getPluginURL();
        $imagePathURL = $pluginURL . 'assets/img/extension-logos';
        switch ($module) {
            case self::AUTOMATION:
                return $imagePathURL . '/automation.svg';
            case self::EVENTS_MANAGER:
                return $imagePathURL . '/events-manager.webp';
            case self::MULTILINGUALPRESS:
                return $imagePathURL . '/multilingualpress.webp';
            case self::POLYLANG:
                return $imagePathURL . '/polylang.webp';
            case self::TRANSLATION:
                return $imagePathURL . '/translation.svg';
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
            case self::AUTOMATION:
                return [
                    PremiumExtensionModuleResolver::AUTOMATION,
                ];
            case self::EVENTS_MANAGER:
                return [
                    PremiumExtensionModuleResolver::EVENTS_MANAGER,
                ];
            case self::MULTILINGUALPRESS:
                return [
                    PremiumExtensionModuleResolver::MULTILINGUALPRESS,
                ];
            case self::POLYLANG:
                return [
                    PremiumExtensionModuleResolver::POLYLANG,
                ];
            case self::TRANSLATION:
                return [
                    PremiumExtensionModuleResolver::CHATGPT_TRANSLATION,
                    PremiumExtensionModuleResolver::CLAUDE_TRANSLATION,
                    PremiumExtensionModuleResolver::DEEPL,
                    PremiumExtensionModuleResolver::GOOGLE_TRANSLATE,
                    PremiumExtensionModuleResolver::TRANSLATION,
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
        return [];
    }
}
