<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Services\MenuPages;

use Exception;
use GatoGraphQL\GatoGraphQL\App;
use GatoGraphQL\GatoGraphQL\Constants\RequestParams;
use GatoGraphQL\GatoGraphQL\Container\ContainerManagerInterface;
use GatoGraphQL\GatoGraphQL\Facades\UserSettingsManagerFacade;
use GatoGraphQL\GatoGraphQL\Marketplace\LicenseValidationServiceInterface;
use GatoGraphQL\GatoGraphQL\ModuleResolvers\EndpointFunctionalityModuleResolver;
use GatoGraphQL\GatoGraphQL\ModuleResolvers\PluginGeneralSettingsFunctionalityModuleResolver;
use GatoGraphQL\GatoGraphQL\ModuleResolvers\PluginManagementFunctionalityModuleResolver;
use GatoGraphQL\GatoGraphQL\ModuleSettings\Properties;
use GatoGraphQL\GatoGraphQL\PluginApp;
use GatoGraphQL\GatoGraphQL\Registries\ModuleRegistryInterface;
use GatoGraphQL\GatoGraphQL\Registries\SettingsCategoryRegistryInterface;
use GatoGraphQL\GatoGraphQL\SettingsCategoryResolvers\SettingsCategoryResolver;
use GatoGraphQL\GatoGraphQL\Settings\OptionNamespacerInterface;
use GatoGraphQL\GatoGraphQL\Settings\Options;
use GatoGraphQL\GatoGraphQL\Settings\SettingsNormalizerInterface;
use GatoGraphQL\GatoGraphQL\Settings\UserSettingsManagerInterface;
use PoP\ComponentModel\Configuration\RequestHelpers;
use PoP\ComponentModel\Constants\FrameworkParams;

use function __;
use function add_action;
use function add_settings_field;
use function add_settings_section;
use function do_settings_fields;
use function error_log;
use function esc_attr;
use function esc_html;
use function esc_url;
use function register_setting;
use function settings_errors;
use function settings_fields;
use function submit_button;
use function update_option;
use function wp_enqueue_script;
use function wp_enqueue_style;

/**
 * Settings menu page
 */
class SettingsMenuPage extends AbstractPluginMenuPage
{
    use UseTabpanelMenuPageTrait;
    use UseDocsMenuPageTrait;
    use UseCollapsibleContentMenuPageTrait;

    public const FORM_ORIGIN = 'form-origin';
    public const FORM_FIELD_LAST_SAVED_TIMESTAMP = 'last_saved_timestamp';
    public const RESET_SETTINGS_BUTTON_ID = 'submit-reset-settings';
    public const ACTIVATE_EXTENSIONS_BUTTON_ID = 'submit-activate-extensions';

    /**
     * @var \GatoGraphQL\GatoGraphQL\Settings\UserSettingsManagerInterface|null
     */
    private $userSettingsManager;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Settings\SettingsNormalizerInterface|null
     */
    private $settingsNormalizer;
    /**
     * @var \GatoGraphQL\GatoGraphQL\ModuleResolvers\PluginGeneralSettingsFunctionalityModuleResolver|null
     */
    private $PluginGeneralSettingsFunctionalityModuleResolver;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Registries\SettingsCategoryRegistryInterface|null
     */
    private $settingsCategoryRegistry;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Registries\ModuleRegistryInterface|null
     */
    private $moduleRegistry;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Marketplace\LicenseValidationServiceInterface|null
     */
    private $licenseValidationService;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Container\ContainerManagerInterface|null
     */
    private $containerManager;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Settings\OptionNamespacerInterface|null
     */
    private $optionNamespacer;

    final protected function getUserSettingsManager(): UserSettingsManagerInterface
    {
        return $this->userSettingsManager = $this->userSettingsManager ?? UserSettingsManagerFacade::getInstance();
    }
    final protected function getSettingsNormalizer(): SettingsNormalizerInterface
    {
        if ($this->settingsNormalizer === null) {
            /** @var SettingsNormalizerInterface */
            $settingsNormalizer = $this->instanceManager->getInstance(SettingsNormalizerInterface::class);
            $this->settingsNormalizer = $settingsNormalizer;
        }
        return $this->settingsNormalizer;
    }
    final protected function getPluginGeneralSettingsFunctionalityModuleResolver(): PluginGeneralSettingsFunctionalityModuleResolver
    {
        if ($this->PluginGeneralSettingsFunctionalityModuleResolver === null) {
            /** @var PluginGeneralSettingsFunctionalityModuleResolver */
            $PluginGeneralSettingsFunctionalityModuleResolver = $this->instanceManager->getInstance(PluginGeneralSettingsFunctionalityModuleResolver::class);
            $this->PluginGeneralSettingsFunctionalityModuleResolver = $PluginGeneralSettingsFunctionalityModuleResolver;
        }
        return $this->PluginGeneralSettingsFunctionalityModuleResolver;
    }
    final protected function getSettingsCategoryRegistry(): SettingsCategoryRegistryInterface
    {
        if ($this->settingsCategoryRegistry === null) {
            /** @var SettingsCategoryRegistryInterface */
            $settingsCategoryRegistry = $this->instanceManager->getInstance(SettingsCategoryRegistryInterface::class);
            $this->settingsCategoryRegistry = $settingsCategoryRegistry;
        }
        return $this->settingsCategoryRegistry;
    }
    final protected function getModuleRegistry(): ModuleRegistryInterface
    {
        if ($this->moduleRegistry === null) {
            /** @var ModuleRegistryInterface */
            $moduleRegistry = $this->instanceManager->getInstance(ModuleRegistryInterface::class);
            $this->moduleRegistry = $moduleRegistry;
        }
        return $this->moduleRegistry;
    }
    final protected function getLicenseValidationService(): LicenseValidationServiceInterface
    {
        if ($this->licenseValidationService === null) {
            /** @var LicenseValidationServiceInterface */
            $licenseValidationService = $this->instanceManager->getInstance(LicenseValidationServiceInterface::class);
            $this->licenseValidationService = $licenseValidationService;
        }
        return $this->licenseValidationService;
    }
    final protected function getContainerManager(): ContainerManagerInterface
    {
        if ($this->containerManager === null) {
            /** @var ContainerManagerInterface */
            $containerManager = $this->instanceManager->getInstance(ContainerManagerInterface::class);
            $this->containerManager = $containerManager;
        }
        return $this->containerManager;
    }
    final protected function getOptionNamespacer(): OptionNamespacerInterface
    {
        if ($this->optionNamespacer === null) {
            /** @var OptionNamespacerInterface */
            $optionNamespacer = $this->instanceManager->getInstance(OptionNamespacerInterface::class);
            $this->optionNamespacer = $optionNamespacer;
        }
        return $this->optionNamespacer;
    }

    public function getScreenID(): string
    {
        $isPrivateEndpointDisabled = !$this->getModuleRegistry()->isModuleEnabled(EndpointFunctionalityModuleResolver::PRIVATE_ENDPOINT);
        if ($isPrivateEndpointDisabled) {
            /**
             * Override, because this is the default page, so it is invoked
             * with the menu slug wp-admin/admin.php?page=gatographql,
             * and not the menu page slug wp-admin/admin.php?page=gatographql_settings
             */
            return $this->getMenuName();
        }
        return parent::getScreenID();
    }

    public function getMenuPageSlug(): string
    {
        return 'settings';
    }

    public function getMenuPageTitle(): string
    {
        return __('Settings', 'gatographql');
    }

    /**
     * Initialize the class instance
     */
    public function initialize(): void
    {
        parent::initialize();

        $settingsCategoryRegistry = $this->getSettingsCategoryRegistry();

        $settingsCategory = SettingsCategoryResolver::PLUGIN_MANAGEMENT;
        $option = $settingsCategoryRegistry->getSettingsCategoryResolver($settingsCategory)->getOptionsFormName($settingsCategory);
        add_action(
            "update_option_{$option}",
            /**
             * Based on which button was pressed, do one or another action:
             *
             * - Reset Settings
             * - Activate Extensions
             *
             * Because the form will send all values again, for all sections,
             * restore the other sections. Otherwise, the user might remove
             * the License Key from the input, then switch to Reset Settings,
             * and click there, being completely unaware that the input
             * will be removed in the DB.             *
             *
             * @param array<string,mixed> $oldValue
             * @param array<string,mixed> $values
             * @return array<string,mixed>
             */
            function ($oldValue, array $values) use ($settingsCategory): void {
                // Make sure the user clicked on the corresponding button
                if (
                    !isset($values[self::RESET_SETTINGS_BUTTON_ID])
                    && !isset($values[self::ACTIVATE_EXTENSIONS_BUTTON_ID])
                ) {
                    return;
                }

                if (!is_array($oldValue)) {
                    $oldValue = [];
                }

                // If pressed on the "Reset Settings" button...
                if (isset($values[self::RESET_SETTINGS_BUTTON_ID])) {
                    $this->restoreDBOptionValuesForNonSubmittedFormSections(
                        $settingsCategory,
                        [
                            [
                                PluginManagementFunctionalityModuleResolver::RESET_SETTINGS,
                                PluginManagementFunctionalityModuleResolver::OPTION_USE_RESTRICTIVE_OR_NOT_DEFAULT_BEHAVIOR,
                            ],
                        ],
                        $oldValue,
                        $values,
                    );

                    $this->resetSettings();
                    return;
                }

                // If pressed on the "Activate (Extensions)" button...
                if (isset($values[self::ACTIVATE_EXTENSIONS_BUTTON_ID])) {
                    $this->restoreDBOptionValuesForNonSubmittedFormSections(
                        $settingsCategory,
                        [
                            [
                                PluginManagementFunctionalityModuleResolver::ACTIVATE_EXTENSIONS,
                                PluginManagementFunctionalityModuleResolver::OPTION_COMMERCIAL_EXTENSION_LICENSE_KEYS,
                            ],
                        ],
                        $oldValue,
                        $values,
                    );

                    // Retrieve the previously-stored license keys, and the newly-submitted license keys
                    $settingOptionName = $this->getModuleRegistry()->getModuleResolver(PluginManagementFunctionalityModuleResolver::ACTIVATE_EXTENSIONS)->getSettingOptionName(PluginManagementFunctionalityModuleResolver::ACTIVATE_EXTENSIONS, PluginManagementFunctionalityModuleResolver::OPTION_COMMERCIAL_EXTENSION_LICENSE_KEYS);
                    $this->getLicenseValidationService()->activateDeactivateValidateGatoGraphQLCommercialExtensions(
                        $oldValue[$settingOptionName] ?? [],
                        $values[$settingOptionName] ?? [],
                        PluginManagementFunctionalityModuleResolver::ACTIVATE_EXTENSIONS,
                    );
                    return;
                }
            },
            10,
            2
        );

        /**
         * Keep this variable for if "Plugin Configuration" eventually
         * needs to regenerate the container once again.
         */
        $doesPluginConfigurationSettingsAffectTheServiceContainer = false;
        $regenerateConfigSettingsCategories = [
            'schema' => SettingsCategoryResolver::SCHEMA_CONFIGURATION,
            'endpoint' => SettingsCategoryResolver::ENDPOINT_CONFIGURATION,
            'server' => SettingsCategoryResolver::SERVER_CONFIGURATION,
            'plugin' => SettingsCategoryResolver::PLUGIN_CONFIGURATION,
            'api-keys' => SettingsCategoryResolver::API_KEYS,
        ];
        $regenerateConfigFormOptions = array_map(
            function (string $settingsCategory) use ($settingsCategoryRegistry) {
                return $settingsCategoryRegistry->getSettingsCategoryResolver($settingsCategory)->getOptionsFormName($settingsCategory);
            },
            $regenerateConfigSettingsCategories
        );
        foreach ($regenerateConfigFormOptions as $option) {
            $regenerateContainer = null;
            if (
                $doesPluginConfigurationSettingsAffectTheServiceContainer // @phpstan-ignore-line
                && $option === $regenerateConfigFormOptions['plugin']
            ) {
                $regenerateContainer = true;
            }

            // "Endpoint Configuration" needs to be flushed as it modifies CPT permalinks
            $flushRewriteRules = $option === $regenerateConfigFormOptions['endpoint'];

            /**
             * After saving the settings in the DB:
             * - Flush the rewrite rules, so different URL slugs take effect
             * - Update the timestamp
             *
             * This hooks is also triggered the first time the user saves the settings
             * (i.e. there's no update) thanks to `maybeStoreEmptySettings`
             */
            add_action(
                "update_option_{$option}",
                function () use ($flushRewriteRules, $regenerateContainer) {
                    return $this->getContainerManager()->flushContainer(
                        $flushRewriteRules,
                        $regenerateContainer,
                    );
                }
            );
        }

        /**
         * Register the settings
         */
        add_action(
            'admin_init',
            function () use ($settingsCategoryRegistry): void {
                /**
                 * If for some reason SymfonyDI throws a ServiceNotFoundException,
                 * then catch it and do nothing (i.e. don't let the app explode)
                 */
                try {
                    $settingsItems = $this->getSettingsNormalizer()->getAllSettingsItems();
                    foreach ($settingsCategoryRegistry->getSettingsCategorySettingsCategoryResolvers() as $settingsCategory => $settingsCategoryResolver) {
                        $categorySettingsItems = array_values(array_filter(
                            $settingsItems,
                            /** @param array<string,mixed> $item */
                            function (array $item) use ($settingsCategory) {
                                return $item['settings-category'] === $settingsCategory;
                            }
                        ));
                        $optionsFormName = $settingsCategoryResolver->getOptionsFormName($settingsCategory);
                        foreach ($categorySettingsItems as $item) {
                            $optionsFormModuleSectionName = $this->getOptionsFormModuleSectionName($optionsFormName, $item['id']);
                            $module = $item['module'];
                            add_settings_section(
                                $optionsFormModuleSectionName,
                                // The empty string ensures the render function won't output a h2.
                                '',
                                function (): void {
                                },
                                $optionsFormName
                            );
                            foreach ($item['settings'] as $itemSetting) {
                                add_settings_field(
                                    $itemSetting[Properties::NAME],
                                    $itemSetting[Properties::TITLE] ?? '',
                                    function () use ($module, $itemSetting, $optionsFormName): void {
                                        $type = $itemSetting[Properties::TYPE] ?? null;
                                        $possibleValues = $itemSetting[Properties::POSSIBLE_VALUES] ?? [];
                                        $keyLabels = $itemSetting[Properties::KEY_LABELS] ?? [];
                                        $cssStyle = $itemSetting[Properties::CSS_STYLE] ?? '';
                                        ?>
                                            <div id="section-<?php echo esc_attr($itemSetting[Properties::NAME]) ?>" class="gatographql-settings-item" <?php if (!empty($cssStyle)) :
                                                ?>style="<?php echo esc_attr($cssStyle) ?>"<?php
                                                             endif; ?>>
                                                <?php
                                                if (!empty($possibleValues) && empty($keyLabels)) {
                                                    $this->printSelectField($optionsFormName, $module, $itemSetting);
                                                } elseif ($type === Properties::TYPE_ARRAY) {
                                                    $this->printTextareaField($optionsFormName, $module, $itemSetting);
                                                } elseif ($type === Properties::TYPE_BOOL) {
                                                    $this->printCheckboxField($optionsFormName, $module, $itemSetting);
                                                } elseif ($type === Properties::TYPE_NULL) {
                                                    $this->printLabelField($optionsFormName, $module, $itemSetting);
                                                } elseif ($type === Properties::TYPE_PROPERTY_ARRAY) {
                                                    $this->printMultiInputField($optionsFormName, $module, $itemSetting);
                                                } else {
                                                    $this->printInputField($optionsFormName, $module, $itemSetting);
                                                }
                                                ?>
                                            </div>
                                        <?php
                                    },
                                    $optionsFormName,
                                    $optionsFormModuleSectionName,
                                    [
                                        'label' => $itemSetting[Properties::DESCRIPTION] ?? '',
                                        'id' => $itemSetting[Properties::NAME],
                                    ]
                                );
                            }
                        }

                        /**
                         * Finally register all the settings
                         */
                        register_setting(
                            $optionsFormName,
                            $settingsCategoryResolver->getDBOptionName($settingsCategory),
                            [
                                'type' => 'array',
                                'description' => $settingsCategoryResolver->getName($settingsCategory),
                                /**
                                 * This call is needed to cast the data
                                 * before saving to the DB.
                                 *
                                 * Please notice that this callback may be called twice:
                                 * once triggered by `update_option` and once by `add_option`,
                                 * (which is called by `update_option`).
                                 */
                                'sanitize_callback' => function (array $values) use ($settingsCategory) {
                                    return $this->sanitizeCallback($values, $settingsCategory);
                                },
                                'show_in_rest' => false,
                            ]
                        );
                    }
                } catch (Exception $exception) {
                    // Log the error, but otherwise do nothing
                    error_log($exception->__toString());
                }
            }
        );
    }

    /**
     * "Plugin Management Settings": Restore the stored values for the
     * contiguous sections in the form (i.e. the other ones to the
     * submitted section where the button was clicked).
     *
     * To restore the values:
     *
     * - Use the old values from the hook
     * - Remove the clicked button from the form, as to avoid infinite looping here
     * - Override the new values, just for the submitted section
     *
     * @param array<array{0:string,1:string}> $formSubmittedModuleOptionItems Form items that must be stored in the DB (everything else will be restored), with item format: [0]: module, [1]: option
     * @param array<string,mixed> $oldValue
     * @param array<string,mixed> $values
     */
    protected function restoreDBOptionValuesForNonSubmittedFormSections(string $settingsCategory, array $formSubmittedModuleOptionItems, array $oldValue, array $values): void
    {
        $dbOptionName = $this->getSettingsCategoryRegistry()->getSettingsCategoryResolver($settingsCategory)->getDBOptionName($settingsCategory);
        // Always transfer the "last_saved_timestamp" field
        $storeSettingOptionNames = [
            self::FORM_FIELD_LAST_SAVED_TIMESTAMP,
        ];
        foreach ($formSubmittedModuleOptionItems as $formSubmittedModuleOptionItem) {
            $module = $formSubmittedModuleOptionItem[0];
            $option = $formSubmittedModuleOptionItem[1];
            $moduleResolver = $this->getModuleRegistry()->getModuleResolver($module);
            $settingOptionName = $moduleResolver->getSettingOptionName($module, $option);
            $storeSettingOptionNames[] = $settingOptionName;
        }
        $restoredValues = $oldValue;
        foreach ($storeSettingOptionNames as $transferSettingOptionName) {
            $restoredValues[$transferSettingOptionName] = $values[$transferSettingOptionName];
        }
        update_option($dbOptionName, $restoredValues);
    }

    /**
     * Delete the Settings and flush
     */
    protected function resetSettings(): void
    {
        $userSettingsManager = $this->getUserSettingsManager();
        $resetOptions = array_map(
            \Closure::fromCallable([$this->getOptionNamespacer(), 'namespaceOption']),
            [
                Options::ENDPOINT_CONFIGURATION,
                Options::SCHEMA_CONFIGURATION,
                Options::SCHEMA_TYPE_CONFIGURATION,
                Options::SERVER_CONFIGURATION,
                Options::PLUGIN_CONFIGURATION,
            ]
        );
        foreach ($resetOptions as $option) {
            $userSettingsManager->storeEmptySettings($option);
        }

        /**
         * Keep this variable for if "Plugin Configuration" eventually
         * needs to regenerate the container once again.
         */
        $doesPluginConfigurationSettingsAffectTheServiceContainer = false;
        $regenerateContainer = null;
        if ($doesPluginConfigurationSettingsAffectTheServiceContainer) { // @phpstan-ignore-line
            $regenerateContainer = true;
        }
        $this->getContainerManager()->flushContainer(true, $regenerateContainer);
    }

    /**
     * @param array<string,mixed> $values
     * @return array<string,mixed>
     */
    protected function sanitizeCallback(array $values, string $settingsCategory): array
    {
        return $this->getSettingsNormalizer()->normalizeSettingsByCategory($values, $settingsCategory);
    }

    protected function getOptionsFormModuleSectionName(string $optionsFormName, string $moduleID): string
    {
        return $optionsFormName . '-' . $moduleID;
    }

    /**
     * The user can define this behavior through the Settings.
     *
     * - If `true`, print the module sections using tabs
     * - If `false`, print the module sections one below the other
     *
     * The outer sections, i.e. settings category, always uses tabs
     */
    protected function printModuleSettingsWithTabs(): bool
    {
        return $this->getUserSettingsManager()->getSetting(
            PluginGeneralSettingsFunctionalityModuleResolver::GENERAL,
            PluginGeneralSettingsFunctionalityModuleResolver::OPTION_PRINT_SETTINGS_WITH_TABS
        );
    }

    /**
     * Print the settings form
     */
    public function print(): void
    {
        $settingsItems = $this->getSettingsNormalizer()->getAllSettingsItems();
        if (!$settingsItems) {
            esc_html_e('There are no items to be configured', 'gatographql');
            return;
        }

        $printModuleSettingsWithTabs = $this->printModuleSettingsWithTabs();

        $settingsCategoryRegistry = $this->getSettingsCategoryRegistry();
        $primarySettingsCategorySettingsCategoryResolvers = $settingsCategoryRegistry->getSettingsCategorySettingsCategoryResolvers();

        /**
         * Find out which primary tab will be selected:
         * Either the one whose ID is passed by ?category=...,
         * or the 1st one otherwise.
         */
        $activeCategoryID = null;
        $activeCategory = App::query(RequestParams::CATEGORY);
        if ($activeCategory !== null) {
            foreach ($primarySettingsCategorySettingsCategoryResolvers as $settingsCategory => $settingsCategoryResolver) {
                $settingsCategoryID = $settingsCategoryResolver->getID($settingsCategory);
                if ($settingsCategoryID !== $activeCategory) {
                    continue;
                }
                $activeCategoryID = $settingsCategoryID;
                break;
            }
        }

        $activeModule = App::query(RequestParams::MODULE);
        $class = 'wrap';
        if ($printModuleSettingsWithTabs) {
            $class .= ' gatographql-tabpanel vertical-tabs';
        }

        // This page URL
        $url = admin_url(sprintf(
            'admin.php?page=%s',
            esc_attr(App::request('page') ?? App::query('page', ''))
        ));

        $time = time();

        // Specify to only toggle the outer .tab-content divs (skip the inner ones)
        ?>
            <div
                id="gatographql-primary-settings"
                class="wrap gatographql-tabpanel"
                data-tab-content-target="#gatographql-primary-settings-nav-tab-content > .tab-content"
            >
                <h1><?php print(esc_html($this->getPageTitle())); ?></h1>
                <?php settings_errors(); ?>
                <div class="nav-tab-container">
                    <!-- Tabs -->
                    <h2 class="nav-tab-wrapper">
                        <?php
                        foreach ($primarySettingsCategorySettingsCategoryResolvers as $settingsCategory => $settingsCategoryResolver) {
                            // Make sure the category has items, otherwise skip
                            $categorySettingsItems = $this->getCategorySettingsItems(
                                $settingsCategory,
                                $settingsItems,
                            );
                            if ($categorySettingsItems === []) {
                                continue;
                            }
                            $settingsCategoryID = $settingsCategoryResolver->getID($settingsCategory);
                            /**
                             * Check this inside the foreach, so that if not all items are shown
                             * (eg: disabled modules in Standalone plugins), then the 1st item
                             * from the filtered elements will be used
                             */
                            if ($activeCategoryID === null) {
                                $activeCategoryID = $settingsCategoryID;
                            }
                            ?>
                                <a
                                    href="#<?php echo esc_attr($settingsCategoryID) ?>"
                                    class="nav-tab <?php echo esc_attr($settingsCategoryID === $activeCategoryID ? 'nav-tab-active' : '') ?>"
                                >
                                    <?php echo esc_html($settingsCategoryResolver->getName($settingsCategory)) ?>
                                </a>
                            <?php
                        }
                        ?>
                    </h2>
                    <div id="gatographql-primary-settings-nav-tab-content" class="nav-tab-content">
                        <?php
                        foreach ($primarySettingsCategorySettingsCategoryResolvers as $settingsCategory => $settingsCategoryResolver) {
                            $settingsCategoryID = $settingsCategoryResolver->getID($settingsCategory);
                            $optionsFormName = $settingsCategoryResolver->getOptionsFormName($settingsCategory);
                            $sectionStyle = sprintf(
                                'display: %s;',
                                $settingsCategoryID === $activeCategoryID ? 'block' : 'none'
                            );
                            $categorySettingsItems = $this->getCategorySettingsItems(
                                $settingsCategory,
                                $settingsItems,
                            );
                            if ($categorySettingsItems === []) {
                                continue;
                            }
                            ?>
                            <div id="<?php echo esc_attr($settingsCategoryID) ?>" class="tab-content" style="<?php echo esc_attr($sectionStyle) ?>">
                            <?php
                                // By default, focus on the first module
                                $activeModuleID = $categorySettingsItems[0]['id'];
                                // If passing a tab, focus on that one, if the module exists
                            if ($activeModule !== null) {
                                $moduleIDs = array_map(
                                    function ($item) {
                                        return $item['id'];
                                    },
                                    $categorySettingsItems
                                );
                                if (in_array($activeModule, $moduleIDs)) {
                                    $activeModuleID = $activeModule;
                                }
                            }
                            ?>
                                <div class="<?php echo esc_attr($class) ?>">
                                    <?php if ($printModuleSettingsWithTabs) : ?>
                                        <div class="nav-tab-container">
                                            <!-- Tabs -->
                                            <h2 class="nav-tab-wrapper">
                                                <?php
                                                foreach ($categorySettingsItems as $item) {
                                                    /**
                                                     * Also add the tab to the URL, not because it is needed,
                                                     * but because we can then "Open in new tab" and it will
                                                     * be focused already on that item.
                                                     */
                                                    $settingsURL = sprintf(
                                                        '%1$s&%2$s=%3$s&%4$s=%5$s',
                                                        $url,
                                                        RequestParams::CATEGORY,
                                                        $settingsCategoryID,
                                                        RequestParams::MODULE,
                                                        $item['id']
                                                    );
                                                    ?>
                                                        <a
                                                            data-tab-target="#<?php echo esc_attr($item['id']) ?>"
                                                            href="<?php echo esc_url($settingsURL) ?>"
                                                            class="nav-tab <?php echo esc_attr($item['id'] === $activeModuleID ? 'nav-tab-active' : '') ?>"
                                                        >
                                                            <?php echo esc_html($item['name']) ?>
                                                        </a>
                                                    <?php
                                                }
                                                ?>
                                            </h2>
                                            <div class="nav-tab-content">
                                    <?php endif; ?>
                                                <form method="post" action="options.php">
                                                    <!-- Artificial input as flag that the form belongs to this plugin -->
                                                    <input type="hidden" name="<?php echo esc_attr(self::FORM_ORIGIN) ?>" value="<?php echo esc_attr($optionsFormName) ?>" />
                                                    <!--
                                                        Artificial input to trigger the update of the form always, as to always purge the container/operational cache
                                                        (eg: to include 3rd party extensions in the service container, or new Gutenberg blocks)
                                                        This is needed because "If the new and old values are the same, no need to update."
                                                        which makes "update_option_{$option}" not be triggered when there are no changes
                                                        @see wp-includes/option.php
                                                    -->
                                                    <input type="hidden" name="<?php echo esc_attr($optionsFormName)?>[<?php echo esc_attr(self::FORM_FIELD_LAST_SAVED_TIMESTAMP) ?>]" value="<?php echo esc_attr((string)$time) ?>">
                                                    <?php if (RequestHelpers::isRequestingXDebug()) : ?>
                                                        <input type="hidden" name="<?php echo esc_attr(FrameworkParams::XDEBUG_TRIGGER) ?>" value="1">
                                                        <input type="hidden" name="<?php echo esc_attr(FrameworkParams::XDEBUG_SESSION_STOP) ?>" value="1">
                                                    <?php endif; ?>
                                                    <!-- Panels -->
                                                    <?php
                                                    $sectionClass = $printModuleSettingsWithTabs ? 'tab-content' : '';
                                                    settings_fields($optionsFormName);
                                                    foreach ($categorySettingsItems as $item) {
                                                        $sectionStyle = '';
                                                        if ($printModuleSettingsWithTabs) {
                                                            $sectionStyle = sprintf(
                                                                'display: %s;',
                                                                $item['id'] === $activeModuleID ? 'block' : 'none'
                                                            );
                                                        }
                                                        ?>
                                                        <div id="<?php echo esc_attr($item['id']) ?>" class="gatographql-settings-section <?php echo esc_attr($sectionClass) ?>" style="<?php echo esc_attr($sectionStyle) ?>">
                                                            <?php if ($printModuleSettingsWithTabs) { ?>
                                                                <h2><?php echo esc_html($item['name']) ?></h2><hr/>
                                                            <?php } else { ?>
                                                                <br/><h2 id="<?php echo esc_attr($item['id']) ?>"><?php echo esc_html($item['name']) ?></h2>
                                                            <?php } ?>
                                                            <table class="form-table">
                                                                <?php do_settings_fields($optionsFormName, $this->getOptionsFormModuleSectionName($optionsFormName, $item['id'])) ?>
                                                            </table>
                                                            <br/>
                                                            <hr/>
                                                        </div>
                                                        <?php
                                                    }
                                                    if ($settingsCategoryResolver->addOptionsFormSubmitButton($settingsCategory)) {
                                                        submit_button(
                                                            sprintf(
                                                                __('Save All Changes (\'%s\' tab)', 'gatographql'),
                                                                $settingsCategoryResolver->getName($settingsCategory)
                                                            )
                                                        );
                                                    }
                                                    ?>
                                                </form>
                                    <?php if ($printModuleSettingsWithTabs) : ?>
                                            </div> <!-- class="nav-tab-content" -->
                                        </div> <!-- class="nav-tab-container" -->
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
<?php
    }

    protected function getPageTitle(): string
    {
        return sprintf(
            __('%s — %s', 'gatographql'),
            PluginApp::getMainPlugin()->getPluginName(),
            $this->getMenuPageTitle()
        );
    }

    /**
     * Filter all the category settings that must be printed
     * under the current section
     *
     * @param array<array<string,mixed>> $settingsItems
     * @return array<array<string,mixed>>
     */
    protected function getCategorySettingsItems(string $settingsCategory, array $settingsItems): array
    {
        return array_values(array_filter(
            $settingsItems,
            /** @param array<string,mixed> $settingsItem */
            function (array $settingsItem) use ($settingsCategory) {
                return $settingsItem['settings-category'] === $settingsCategory;
            }
        ));
    }

    /**
     * Enqueue the required assets and initialize the localized scripts
     */
    protected function enqueueAssets(): void
    {
        parent::enqueueAssets();

        $this->enqueueDocsAssets();

        $this->enqueueSettingsAssets();

        $this->enqueueCollapsibleContentAssets();

        /**
         * Always enqueue (even if printModuleSettingsWithTabs() is false) as the
         * outer level (for settings category) uses tabs
         */
        $this->enqueueTabpanelAssets();
    }

    /**
     * Enqueue the required assets
     */
    protected function enqueueSettingsAssets(): void
    {
        $mainPlugin = PluginApp::getMainPlugin();
        $mainPluginURL = $mainPlugin->getPluginURL();
        $mainPluginVersion = $mainPlugin->getPluginVersion();

        wp_enqueue_script(
            'gatographql-settings',
            $mainPluginURL . 'assets/js/settings.js',
            array('jquery'),
            $mainPluginVersion
        );
        wp_enqueue_style(
            'gatographql-settings',
            $mainPluginURL . 'assets/css/settings.css',
            array(),
            $mainPluginVersion
        );
    }

    /**
     * Get the option value
     * @return mixed
     */
    protected function getOptionValue(string $module, string $option)
    {
        return $this->getUserSettingsManager()->getSetting($module, $option);
    }

    /**
     * Display a checkbox field.
     *
     * @param array<string,mixed> $itemSetting
     */
    protected function printCheckboxField(string $optionsFormName, string $module, array $itemSetting): void
    {
        $name = $itemSetting[Properties::NAME];
        $input = $itemSetting[Properties::INPUT];
        $value = $this->getOptionValue($module, $input);
        $description_safe = $itemSetting[Properties::DESCRIPTION] ?? '';
        ?>
            <label for="<?php echo esc_attr($name); ?>" style="cursor: pointer;">
                <input type="checkbox" name="<?php echo esc_attr($optionsFormName . '[' . $name . ']'); ?>" id="<?php echo esc_attr($name); ?>" value="1" <?php checked(1, $value); ?> />
                <?php echo $description_safe; ?>
            </label>
        <?php
    }

    /**
     * Display a label
     *
     * @param array<string,mixed> $itemSetting
     */
    protected function printLabelField(string $optionsFormName, string $module, array $itemSetting): void
    {
        $description_safe = $itemSetting[Properties::DESCRIPTION] ?? '';
        ?>
            <?php echo $description_safe; ?>
        <?php
    }

    /**
     * Display an input field.
     *
     * @param array<string,mixed> $itemSetting
     */
    protected function printInputField(string $optionsFormName, string $module, array $itemSetting): void
    {
        $name = $itemSetting[Properties::NAME];
        $input = $itemSetting[Properties::INPUT];
        $value = $this->getOptionValue($module, $input);
        $label_safe = isset($itemSetting[Properties::DESCRIPTION]) ? '<br/>' . $itemSetting[Properties::DESCRIPTION] : '';
        $isNumber = isset($itemSetting[Properties::TYPE]) && $itemSetting[Properties::TYPE] === Properties::TYPE_INT;
        $minNumber = null;
        if ($isNumber) {
            $minNumber = $itemSetting[Properties::MIN_NUMBER] ?? null;
        }
        $isPassword = ($itemSetting[Properties::TYPE] ?? null) === Properties::TYPE_STRING && ($itemSetting[Properties::SUBTYPE] ?? null) === Properties::TYPE_PASSWORD;
        $useTextarea = $itemSetting[Properties::USE_TEXTAREA] ?? false;
        ?>
            <label for="<?php echo esc_attr($name); ?>">
                <?php
                if ($useTextarea) {
                    ?>
                    <textarea
                        name="<?php echo esc_attr($optionsFormName . '[' . $name . ']'); ?>"
                        id="<?php echo esc_attr($name); ?>"
                        rows="10"
                        cols="50"
                    ><?php echo esc_attr($value) ?></textarea>
                    <?php
                } else {
                    ?>
                    <input
                        name="<?php echo esc_attr($optionsFormName . '[' . $name . ']'); ?>"
                        id="<?php echo esc_attr($name); ?>"
                        value="<?php echo esc_attr($value); ?>"
                        class="regular-text"
                        <?php if ($isNumber) { ?>
                            type="number"
                            step="1"
                            <?php if ($minNumber !== null) { ?>
                                min="<?php echo esc_attr($minNumber) ?>"
                            <?php } ?>
                        <?php } elseif ($isPassword) { ?>
                            type="password"
                        <?php } else { ?>
                            type="text"
                        <?php } ?>
                    />
                    <?php
                }
                echo $label_safe;
                ?>
            </label>
        <?php
    }

    /**
     * Display a "Property Array" field as a collection of inputs
     *
     * @param array<string,mixed> $itemSetting
     */
    protected function printMultiInputField(string $optionsFormName, string $module, array $itemSetting): void
    {
        $name = $itemSetting[Properties::NAME];
        $input = $itemSetting[Properties::INPUT];
        $value = $this->getOptionValue($module, $input);
        // If it is multiple, $value is an array.
        // To simplify, deal always with arrays
        if (!is_array($value)) {
            $value = $value === null ? [] : [$value];
        }
        $addSpacing = false;
        if (isset($itemSetting[Properties::DESCRIPTION])) {
            $addSpacing = true;
            $description_safe = $itemSetting[Properties::DESCRIPTION];
            echo $description_safe;
        }
        $keyLabels = $itemSetting[Properties::KEY_LABELS] ?? [];
        $possibleValues = $itemSetting[Properties::POSSIBLE_VALUES] ?? [];
        $isMultiple = $itemSetting[Properties::IS_MULTIPLE] ?? false;
        $subtype = $itemSetting[Properties::SUBTYPE] ?? null;
        $isMultipleBool = empty($possibleValues) && $subtype === Properties::TYPE_BOOL;
        $isPassword = $subtype === Properties::TYPE_PASSWORD;
        $defaultValue = $itemSetting[Properties::DEFAULT_VALUE] ?? null;
        foreach ($keyLabels as $key => $label) {
            $id = $name . '_' . $key;
            if ($addSpacing) {
                ?>
                <br/><br/>
                <?php
            }
            ?>
            <label for="<?php echo esc_attr($id) ?>"  <?php if ($isMultipleBool) :
                ?>style="cursor: pointer;"<?php
                        endif; ?>>
                <?php
                if ($isMultipleBool) {
                    ?>
                    <input type="checkbox" name="<?php echo esc_attr($optionsFormName . '[' . $name . '][' . $key . ']'); ?>" id="<?php echo esc_attr($id); ?>" value="1" <?php checked(true, esc_html($value[$key] ?? false)); ?> />
                    <?php
                }
                ?>
                <strong><?php echo esc_html($label); ?></strong>
                <?php
                if (!$isMultipleBool) {
                    ?>
                    <br/>
                    <?php
                    if (empty($possibleValues)) {
                        ?>
                        <input
                            name="<?php echo esc_attr($optionsFormName . '[' . $name . '][' . $key . ']'); ?>"
                            id="<?php echo esc_attr($id) ?>"
                            class="regular-text"
                            value="<?php echo esc_html($value[$key] ?? '') ?>"
                            <?php if ($isPassword) : ?>
                                type="password"
                            <?php else : ?>
                                type="text"
                            <?php endif; ?>
                            
                        >
                        <?php
                    } else {
                        ?>
                        <select
                            name="<?php echo esc_attr($optionsFormName . '[' . $name . '][' . $key . ']' . ($isMultiple ? '[]' : '')); ?>"
                            id="<?php echo esc_attr($id) ?>"
                            class="regular-text"
                        <?php if ($isMultiple) : ?>
                                multiple="multiple"
                                size="10"
                        <?php endif; ?>
                        >
                        <?php foreach ($possibleValues as $optionValue => $optionLabel) : ?>
                                <option
                                    value="<?php echo esc_attr($optionValue) ?>"
                                    <?php if ($optionValue === ($value[$key] ?? $defaultValue)) : ?>
                                        selected="selected"
                                    <?php endif; ?>
                                >
                                    <?php echo esc_html($optionLabel) ?>
                                </option>
                        <?php endforeach ?>
                        </select>
                        <?php
                    }
                }
                ?>
            </label>
            <?php
            $addSpacing = true;
        }
    }

    /**
     * Display a select field.
     *
     * @param array<string,mixed> $itemSetting
     */
    protected function printSelectField(string $optionsFormName, string $module, array $itemSetting): void
    {
        $name = $itemSetting[Properties::NAME];
        $input = $itemSetting[Properties::INPUT];
        $value = $this->getOptionValue($module, $input);
        // If it is multiple, $value is an array.
        // To simplify, deal always with arrays
        if (!is_array($value)) {
            $value = $value === null ? [] : [$value];
        }
        $label_safe = isset($itemSetting[Properties::DESCRIPTION]) ? '<br/>' . $itemSetting[Properties::DESCRIPTION] : '';
        $isMultiple = $itemSetting[Properties::IS_MULTIPLE] ?? false;
        $possibleValues = $itemSetting[Properties::POSSIBLE_VALUES] ?? [];
        ?>
            <label for="<?php echo esc_attr($name); ?>">
                <select
                    name="<?php echo esc_attr($optionsFormName . '[' . $name . ']' . ($isMultiple ? '[]' : '')); ?>"
                    id="<?php echo esc_attr($name); ?>"
                    class="regular-text"
                    <?php if ($isMultiple) : ?>
                        multiple="multiple"
                        size="10"
                    <?php endif; ?>
                >
                <?php foreach ($possibleValues as $optionValue => $optionLabel) : ?>
                    <option
                        value="<?php echo esc_attr($optionValue) ?>"
                        <?php if (in_array($optionValue, $value)) : ?>
                            selected="selected"
                        <?php endif; ?>
                    >
                        <?php echo esc_html($optionLabel) ?>
                    </option>
                <?php endforeach ?>
                </select>
                <?php echo $label_safe; ?>
            </label>
        <?php
    }

    /**
     * Display a textarea field.
     *
     * @param array<string,mixed> $itemSetting
     */
    protected function printTextareaField(string $optionsFormName, string $module, array $itemSetting): void
    {
        $name = $itemSetting[Properties::NAME];
        $input = $itemSetting[Properties::INPUT];
        // This must be an array
        $value = $this->getOptionValue($module, $input);
        $label_safe = isset($itemSetting[Properties::DESCRIPTION]) ? '<br/>' . $itemSetting[Properties::DESCRIPTION] : '';
        ?>
            <label for="<?php echo esc_attr($name); ?>">
                <textarea
                    name="<?php echo esc_attr($optionsFormName . '[' . $name . ']'); ?>"
                    id="<?php echo esc_attr($name); ?>"
                    rows="10"
                    cols="50"
                ><?php echo esc_html(implode("\n", $value)) ?></textarea>
                <?php echo $label_safe; ?>
            </label>
        <?php
    }
}
