<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Settings;

use GatoGraphQL\GatoGraphQL\Facades\Registries\SystemModuleRegistryFacade;
use GatoGraphQL\GatoGraphQL\Facades\Registries\SystemSettingsCategoryRegistryFacade;
use GatoGraphQL\GatoGraphQL\Facades\Settings\OptionNamespacerFacade;
use GatoGraphQL\GatoGraphQL\Facades\TimestampSettingsManagerFacade;
use GatoGraphQL\GatoGraphQL\Facades\TransientSettingsManagerFacade;

use function get_option;
use function uniqid;
use function update_option;

class UserSettingsManager implements UserSettingsManagerInterface
{
    private const TIMESTAMP_CONTAINER = 'container';
    private const TIMESTAMP_OPERATIONAL = 'operational';
    private const TRANSIENT_LICENSE_ACTIVATION = 'license-activation';
    private const TRANSIENT_PLUGIN_OR_THEME_STATUS_CHANGE = 'plugin-or-theme-status-change';
    private const TIMESTAMP_LICENSE_CHECK = 'license-check';
    /**
     * Cache the values in memory
     *
     * @var array<string,array<string,mixed>>
     */
    protected $options = [];

    /**
     * @var \GatoGraphQL\GatoGraphQL\Settings\TimestampSettingsManagerInterface|null
     */
    private $timestampSettingsManager;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Settings\TransientSettingsManagerInterface|null
     */
    private $transientSettingsManager;
    /**
     * @var \GatoGraphQL\GatoGraphQL\Settings\OptionNamespacerInterface|null
     */
    private $optionNamespacer;

    final protected function getTimestampSettingsManager(): TimestampSettingsManagerInterface
    {
        return $this->timestampSettingsManager = $this->timestampSettingsManager ?? TimestampSettingsManagerFacade::getInstance();
    }
    final protected function getTransientSettingsManager(): TransientSettingsManagerInterface
    {
        return $this->transientSettingsManager = $this->transientSettingsManager ?? TransientSettingsManagerFacade::getInstance();
    }
    final protected function getOptionNamespacer(): OptionNamespacerInterface
    {
        return $this->optionNamespacer = $this->optionNamespacer ?? OptionNamespacerFacade::getInstance();
    }

    /**
     * Timestamp of latest executed write to DB, concerning plugin activation,
     * module enabled/disabled, user settings updated.
     *
     * If there is not timestamp yet, then we just installed the plugin.
     *
     * In that case, we must return a random `time()` timestamp and not
     * a fixed value such as `0`, because the service container
     * will be generated on each interaction with WordPress,
     * including WP-CLI.
     *
     * Using `0` as the default value, when installing the plugin
     * and an extension via WP-CLI (before accessing wp-admin)
     * it will throw errors, because after installing the main plugin
     * the container cache is generated and cached with timestamp `0`,
     * and it would be loaded again when installing the extension,
     * however the cache does not contain the services from the extension.
     *
     * By providing `time()`, the cached service container is always
     * a one-time-use before accessing the wp-admin and
     * having a new timestamp generated via `purgeContainer`.
     */
    protected function getOptionUniqueTimestamp(string $key): string
    {
        /** @var string */
        $timestamp = $this->getTimestampSettingsManager()->getTimestamp($key, $this->getUniqueIdentifier());
        return $timestamp;
    }

    /**
     * Add a random number to `time()` to make it truly unique,
     * as to avoid a bug when 2 requests with different schema
     * configuration come in at the same time (i.e. with same `time()`).
     */
    protected function getUniqueIdentifier(): string
    {
        return uniqid();
    }
    /**
     * Static timestamp, reflecting when the service container has been regenerated.
     * Should change not so often
     */
    public function getContainerUniqueTimestamp(): string
    {
        return $this->getOptionUniqueTimestamp(self::TIMESTAMP_CONTAINER);
    }
    /**
     * Dynamic timestamp, reflecting when new entities modifying the schema are
     * added to the DB. Can change often
     */
    public function getOperationalUniqueTimestamp(): string
    {
        return $this->getOptionUniqueTimestamp(self::TIMESTAMP_OPERATIONAL);
    }
    /**
     * Store the current time to indicate the latest executed write to DB,
     * concerning plugin activation, module enabled/disabled, user settings updated,
     * to refresh the Service Container.
     *
     * When this value is updated, the "operational" timestamp is also updated.
     */
    public function storeContainerTimestamp(): void
    {
        $uniqueID = $this->getUniqueIdentifier();
        $timestamps = [
            self::TIMESTAMP_CONTAINER => $uniqueID,
            self::TIMESTAMP_OPERATIONAL => $uniqueID,
        ];
        $this->getTimestampSettingsManager()->storeTimestamps($timestamps);
    }
    /**
     * Store the current time to indicate the latest executed write to DB,
     * concerning CPT entity created or modified (such as Schema Configuration,
     * ACL, etc), to refresh the GraphQL schema
     */
    public function storeOperationalTimestamp(): void
    {
        $timestamps = [
            self::TIMESTAMP_CONTAINER => $this->getContainerUniqueTimestamp(),
            self::TIMESTAMP_OPERATIONAL => $this->getUniqueIdentifier(),
        ];
        $this->getTimestampSettingsManager()->storeTimestamps($timestamps);
    }
    /**
     * Remove the timestamp
     */
    public function removeTimestamps(): void
    {
        $this->getTimestampSettingsManager()->removeTimestamps([
            self::TIMESTAMP_CONTAINER,
            self::TIMESTAMP_OPERATIONAL,
        ]);
    }

    /**
     * Timestamp of latest executed validation of the commercial
     * licenses against the Marketplace provider's API
     */
    public function getLicenseCheckTimestamp(): ?int
    {
        return $this->getTimestamp(self::TIMESTAMP_LICENSE_CHECK);
    }

    protected function getTimestamp(string $timestampName): ?int
    {
        $timestamp = $this->getTimestampSettingsManager()->getTimestamp($timestampName);
        if ($timestamp === null) {
            return null;
        }
        return (int) $timestamp;
    }

    /**
     * Store the current time to indicate the latest executed
     * validation of the commercial licenses
     */
    public function storeLicenseCheckTimestamp(): void
    {
        $this->storeTimestamp(self::TIMESTAMP_LICENSE_CHECK);
    }

    protected function storeTimestamp(string $timestampName): void
    {
        $this->getTimestampSettingsManager()->storeTimestamp(
            $timestampName,
            (string) time()
        );
    }

    /**
     * Retrieve the extension names whose commercial license has
     * just been activated.
     *
     * @return string[]|null The license-just-activated extension names
     */
    public function getJustActivatedLicenseTransientExtensionNames(): ?array
    {
        return $this->getTransientSettingsManager()->getTransient(self::TRANSIENT_LICENSE_ACTIVATION);
    }

    /**
     * Store the extension names whose commercial license has
     * just been activated.
     *
     * @param string[] $extensionSlugs
     */
    public function storeJustActivatedLicenseTransient(array $extensionSlugs): void
    {
        $this->getTransientSettingsManager()->storeTransient(
            self::TRANSIENT_LICENSE_ACTIVATION,
            $extensionSlugs
        );
    }

    /**
     * Remove the flag to indicate the extension names whose commercial
     * license has just been activated.
     */
    public function removeJustActivatedLicenseTransient(): void
    {
        $this->getTransientSettingsManager()->removeTransients([
            self::TRANSIENT_LICENSE_ACTIVATION,
        ]);
    }

    /**
     * Retrieve the plugin files or theme slugs with status change (active/inactive).
     *
     * @return string[]|null The plugin files or theme slugs with status change
     */
    public function getPluginOrThemeStatusChangeTransient(): ?array
    {
        return $this->getTransientSettingsManager()->getTransient(self::TRANSIENT_PLUGIN_OR_THEME_STATUS_CHANGE);
    }

    /**
     * Store the plugin files or theme slugs with status change (active/inactive).
     *
     * @param string[] $pluginFilesOrThemeSlugs
     */
    public function storePluginOrThemeStatusChangeTransient(array $pluginFilesOrThemeSlugs): void
    {
        $this->getTransientSettingsManager()->storeTransient(
            self::TRANSIENT_PLUGIN_OR_THEME_STATUS_CHANGE,
            $pluginFilesOrThemeSlugs
        );
    }

    /**
     * Remove the plugin or theme status change transient.
     */
    public function removePluginOrThemeStatusChangeTransient(): void
    {
        $this->getTransientSettingsManager()->removeTransients([
            self::TRANSIENT_PLUGIN_OR_THEME_STATUS_CHANGE,
        ]);
    }

    public function hasSetting(string $module, string $option): bool
    {
        $moduleRegistry = SystemModuleRegistryFacade::getInstance();
        $settingsCategoryRegistry = SystemSettingsCategoryRegistryFacade::getInstance();

        $moduleResolver = $moduleRegistry->getModuleResolver($module);
        $settingsCategory = $moduleResolver->getSettingsCategory($module);
        $optionName = $settingsCategoryRegistry->getSettingsCategoryResolver($settingsCategory)->getDBOptionName($settingsCategory);
        $item = $moduleResolver->getSettingOptionName($module, $option);
        return $this->hasItem($optionName, $item);
    }

    /**
     * @return mixed
     */
    public function getSetting(string $module, string $option)
    {
        $moduleRegistry = SystemModuleRegistryFacade::getInstance();
        $settingsCategoryRegistry = SystemSettingsCategoryRegistryFacade::getInstance();

        $moduleResolver = $moduleRegistry->getModuleResolver($module);
        $settingsCategory = $moduleResolver->getSettingsCategory($module);
        $optionName = $settingsCategoryRegistry->getSettingsCategoryResolver($settingsCategory)->getDBOptionName($settingsCategory);
        $item = $moduleResolver->getSettingOptionName($module, $option);

        // If the item is saved in the DB, retrieve it
        if ($this->hasItem($optionName, $item)) {
            return $this->getItem($optionName, $item);
        }

        // Otherwise, return the default value
        return $moduleResolver->getSettingsDefaultValue($module, $option);
    }

    /**
     * @param mixed $value
     */
    public function setSetting(string $module, string $option, $value): void
    {
        $moduleRegistry = SystemModuleRegistryFacade::getInstance();
        $settingsCategoryRegistry = SystemSettingsCategoryRegistryFacade::getInstance();

        $moduleResolver = $moduleRegistry->getModuleResolver($module);
        $settingsCategory = $moduleResolver->getSettingsCategory($module);
        $optionName = $settingsCategoryRegistry->getSettingsCategoryResolver($settingsCategory)->getDBOptionName($settingsCategory);
        $item = $moduleResolver->getSettingOptionName($module, $option);
        $this->setOptionItem($optionName, $item, $value);
    }

    /**
     * @param array<string,mixed> $optionValues
     */
    public function setSettings(string $module, array $optionValues): void
    {
        $moduleRegistry = SystemModuleRegistryFacade::getInstance();
        $settingsCategoryRegistry = SystemSettingsCategoryRegistryFacade::getInstance();

        $moduleResolver = $moduleRegistry->getModuleResolver($module);
        $settingsCategory = $moduleResolver->getSettingsCategory($module);
        $optionName = $settingsCategoryRegistry->getSettingsCategoryResolver($settingsCategory)->getDBOptionName($settingsCategory);

        $itemValues = [];
        foreach ($optionValues as $option => $value) {
            $item = $moduleResolver->getSettingOptionName($module, $option);
            $itemValues[$item] = $value;
        }

        $this->setOptionItems($optionName, $itemValues);
    }

    public function hasSetModuleEnabled(string $moduleID): bool
    {
        return $this->hasItem($this->namespaceOption(Options::MODULES), $moduleID);
    }

    protected function namespaceOption(string $option): string
    {
        return $this->getOptionNamespacer()->namespaceOption($option);
    }

    public function isModuleEnabled(string $moduleID): bool
    {
        return (bool) $this->getItem($this->namespaceOption(Options::MODULES), $moduleID);
    }

    public function setModuleEnabled(string $moduleID, bool $isEnabled): void
    {
        $this->setOptionItem($this->namespaceOption(Options::MODULES), $moduleID, $isEnabled);
    }

    /**
     * @param mixed $value
     */
    protected function setOptionItem(string $optionName, string $item, $value): void
    {
        $this->storeItem($optionName, $item, $value);

        // Update the timestamp
        $this->storeContainerTimestamp();
    }

    /**
     * @param array<string,mixed> $itemValues
     */
    protected function setOptionItems(string $optionName, array $itemValues): void
    {
        $this->storeItems($optionName, $itemValues);

        // Update the timestamp
        $this->storeContainerTimestamp();
    }

    /**
     * @param array<string,bool> $moduleIDValues
     */
    public function setModulesEnabled(array $moduleIDValues): void
    {
        $this->storeItems($this->namespaceOption(Options::MODULES), $moduleIDValues);

        // Update the timestamp
        $this->storeContainerTimestamp();
    }

    /**
     * Get the stored value for the option under the group
     * @return mixed
     */
    protected function getItem(string $optionName, string $item)
    {
        $this->maybeLoadOptions($optionName);
        return $this->options[$optionName][$item];
    }

    /**
     * Is there a stored value for the option under the group
     */
    protected function hasItem(string $optionName, string $item): bool
    {
        $this->maybeLoadOptions($optionName);
        return isset($this->options[$optionName][$item]);
    }

    /**
     * Load the options from the DB
     */
    protected function maybeLoadOptions(string $optionName): void
    {
        // Lazy load the options
        if (!isset($this->options[$optionName])) {
            $this->options[$optionName] = get_option($optionName, []);
        }
    }

    /**
     * Store the options in the DB
     * @param mixed $value
     */
    protected function storeItem(string $optionName, string $item, $value): void
    {
        $this->storeItems($optionName, [$item => $value]);
    }

    /**
     * Store the options in the DB
     *
     * @param array<string,mixed> $itemValues
     */
    protected function storeItems(string $optionName, array $itemValues): void
    {
        $this->maybeLoadOptions($optionName);
        // Change the values of the items
        $this->options[$optionName] = array_merge(
            $this->options[$optionName],
            $itemValues
        );
        // Save to the DB
        update_option($optionName, $this->options[$optionName]);
    }

    public function storeEmptySettings(string $optionName): void
    {
        unset($this->options[$optionName]);
        update_option($optionName, []);
    }
}
