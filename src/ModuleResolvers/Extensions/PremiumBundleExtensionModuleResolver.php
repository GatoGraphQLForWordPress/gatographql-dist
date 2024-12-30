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
    public const DEEPL = Plugin::NAMESPACE . '\\bundle-extensions\\deepl';
    public const EVENTS_MANAGER = Plugin::NAMESPACE . '\\bundle-extensions\\events-manager';
    public const GOOGLE_TRANSLATE = Plugin::NAMESPACE . '\\bundle-extensions\\google-translate';
    public const MULTILINGUALPRESS = Plugin::NAMESPACE . '\\bundle-extensions\\multilingualpress';
    public const POLYLANG = Plugin::NAMESPACE . '\\bundle-extensions\\polylang';

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
            self::DEEPL,
            self::EVENTS_MANAGER,
            self::GOOGLE_TRANSLATE,
            self::MULTILINGUALPRESS,
            self::POLYLANG,
        ];
    }

    public function getName(string $module): string
    {
        switch ($module) {
            case self::AUTOMATION:
                return \__('Automation', 'gatographql');
            case self::DEEPL:
                return \__('DeepL', 'gatographql');
            case self::EVENTS_MANAGER:
                return \__('Events Manager', 'gatographql');
            case self::GOOGLE_TRANSLATE:
                return \__('Google Translate', 'gatographql');
            case self::MULTILINGUALPRESS:
                return \__('MultilingualPress', 'gatographql');
            case self::POLYLANG:
                return \__('Polylang', 'gatographql');
            default:
                return $module;
        }
    }

    public function getDescription(string $module): string
    {
        switch ($module) {
            case self::AUTOMATION:
                return \__('Use GraphQL to automate tasks in your app: Execute queries when some event happens, chain queries, and schedule and trigger queries via WP-Cron. (The Internal GraphQL Server extension is required).', 'gatographql');
            case self::DEEPL:
                return \__('Translate content to multiple languages using the DeepL API.', 'gatographql');
            case self::EVENTS_MANAGER:
                return \__('Integration with plugin "Events Manager", adding fields to the schema to fetch event data.', 'gatographql');
            case self::GOOGLE_TRANSLATE:
                return \__('Translate content to multiple languages using the Google Translate API.', 'gatographql');
            case self::MULTILINGUALPRESS:
                return \__('Integration with plugin "MultilingualPress", adding fields to the schema to fetch multilingual data.', 'gatographql');
            case self::POLYLANG:
                return \__('Integration with plugin "Polylang", adding fields to the schema to fetch multilingual data.', 'gatographql');
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
            case self::DEEPL:
                return $imagePathURL . '/deepl.svg';
            case self::EVENTS_MANAGER:
                return $imagePathURL . '/events-manager.webp';
            case self::GOOGLE_TRANSLATE:
                return $imagePathURL . '/google-translate.svg';
            case self::MULTILINGUALPRESS:
                return $imagePathURL . '/multilingualpress.png';
            case self::POLYLANG:
                return $imagePathURL . '/polylang.png';
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
            case self::DEEPL:
                return [
                    PremiumExtensionModuleResolver::DEEPL,
                    PremiumExtensionModuleResolver::TRANSLATION,
                ];
            case self::EVENTS_MANAGER:
                return [
                    PremiumExtensionModuleResolver::EVENTS_MANAGER,
                ];
            case self::GOOGLE_TRANSLATE:
                return [
                    PremiumExtensionModuleResolver::GOOGLE_TRANSLATE,
                    PremiumExtensionModuleResolver::TRANSLATION,
                ];
            case self::MULTILINGUALPRESS:
                return [
                    PremiumExtensionModuleResolver::MULTILINGUALPRESS,
                ];
            case self::POLYLANG:
                return [
                    PremiumExtensionModuleResolver::POLYLANG,
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
