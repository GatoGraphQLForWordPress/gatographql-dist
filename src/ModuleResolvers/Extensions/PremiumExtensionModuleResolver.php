<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\ModuleResolvers\Extensions;

use GatoGraphQL\GatoGraphQL\Plugin;

class PremiumExtensionModuleResolver extends AbstractExtensionModuleResolver
{
    use PremiumExtensionModuleResolverTrait;

    public const AUTOMATION = Plugin::NAMESPACE . '\\extensions\\automation';
    public const DEEPL = Plugin::NAMESPACE . '\\extensions\\deepl';
    public const EVENTS_MANAGER = Plugin::NAMESPACE . '\\extensions\\events-manager';
    public const GOOGLE_TRANSLATE = Plugin::NAMESPACE . '\\extensions\\google-translate';
    public const MULTILINGUALPRESS = Plugin::NAMESPACE . '\\extensions\\multilingualpress';
    public const POLYLANG = Plugin::NAMESPACE . '\\extensions\\polylang';
    public const TRANSLATION = Plugin::NAMESPACE . '\\extensions\\translation';

    /**
     * @return string[]
     */
    public function getModulesToResolve(): array
    {
        return [
            self::AUTOMATION,
            self::DEEPL,
            self::EVENTS_MANAGER,
            self::GOOGLE_TRANSLATE,
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
            case self::TRANSLATION:
                return \__('Translate content to multiple languages using any provider\'s API.', 'gatographql');
            default:
                return parent::getDescription($module);
        }
    }
}