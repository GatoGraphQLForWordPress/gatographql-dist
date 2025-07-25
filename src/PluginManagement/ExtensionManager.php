<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\PluginManagement;

use GatoGraphQL\ExternalDependencyWrappers\Composer\Semver\SemverWrapper;
use GatoGraphQL\GatoGraphQL\Constants\ExtensionDataOptions;
use GatoGraphQL\GatoGraphQL\Constants\HTMLCodes;
use GatoGraphQL\GatoGraphQL\Exception\ExtensionNotRegisteredException;
use GatoGraphQL\GatoGraphQL\Facades\Registries\ModuleRegistryFacade;
use GatoGraphQL\GatoGraphQL\Facades\Registries\SettingsCategoryRegistryFacade;
use GatoGraphQL\GatoGraphQL\Marketplace\Constants\LicenseStatus;
use GatoGraphQL\GatoGraphQL\ModuleResolvers\PluginManagementFunctionalityModuleResolver;
use GatoGraphQL\GatoGraphQL\ObjectModels\ActiveLicenseCommercialExtensionData;
use GatoGraphQL\GatoGraphQL\PluginApp;
use GatoGraphQL\GatoGraphQL\PluginSkeleton\BundleExtensionInterface;
use GatoGraphQL\GatoGraphQL\PluginSkeleton\ExtensionInterface;
use GatoGraphQL\GatoGraphQL\PluginStaticModuleConfiguration;
use GatoGraphQL\GatoGraphQL\Services\MenuPages\SettingsMenuPage;
use GatoGraphQL\GatoGraphQL\SettingsCategoryResolvers\SettingsCategoryResolver;
use GatoGraphQL\GatoGraphQL\StaticHelpers\AdminHelpers;
use GatoGraphQL\GatoGraphQL\StaticHelpers\PluginVersionHelpers;
use GatoGraphQL\GatoGraphQL\StaticHelpers\SettingsHelpers;
use PoP\Root\Facades\Instances\InstanceManagerFacade;

use function plugin_basename;

class ExtensionManager extends AbstractPluginManager
{
    /** @var string[] */
    private $inactiveExtensionDependedUponPluginFiles = [];

    /** @var string[] */
    private $inactiveExtensionDependedUponThemeSlugs = [];

    /** @var array<string,BundleExtensionInterface> */
    private $bundledExtensionClassBundlingExtensionClasses = [];

    /** @var array<string,ActiveLicenseCommercialExtensionData> Extension Slug => ActiveLicenseCommercialExtensionData */
    private $nonActivatedLicenseCommercialExtensionSlugDataEntries = [];

    /** @var array<string,ActiveLicenseCommercialExtensionData> Extension Slug => ActiveLicenseCommercialExtensionData */
    private $activatedLicenseCommercialExtensionSlugDataEntries = [];

    /** @var array<string,string>|null Extension Slug => Extension Product Name */
    private $commercialExtensionSlugProductNames;

    /**
     * Have the extensions organized by their class
     *
     * @var array<class-string<ExtensionInterface>,ExtensionInterface>
     */
    private $extensionClassInstances = [];

    /**
     * Have the extensions organized by their baseName
     *
     * @var array<string,ExtensionInterface>
     */
    private $extensionBaseNameInstances = [];

    /**
     * Extensions, organized under their name.
     *
     * @return array<string,ExtensionInterface>
     */
    public function getExtensions(): array
    {
        return $this->extensionBaseNameInstances;
    }

    /**
     * @param class-string<ExtensionInterface> $extensionClass
     */
    public function getExtension(string $extensionClass): ExtensionInterface
    {
        if (!isset($this->extensionClassInstances[$extensionClass])) {
            throw new ExtensionNotRegisteredException(
                sprintf(
                    \__('The extension with class \'%s\' has not been registered yet', 'gatographql'),
                    $extensionClass
                )
            );
        }
        return $this->extensionClassInstances[$extensionClass];
    }

    public function register(ExtensionInterface $extension): ExtensionInterface
    {
        $extensionClass = get_class($extension);
        $this->extensionClassInstances[$extensionClass] = $extension;
        $this->extensionBaseNameInstances[$extension->getPluginBaseName()] = $extension;
        return $extension;
    }

    public function registerBundle(BundleExtensionInterface $bundleExtension): ExtensionInterface
    {
        $extension = $this->register($bundleExtension);

        /**
         * Register the bundled Extensions:
         *
         *   We must indicate that all the contained Extensions are in a Bundle,
         *   as to let them decide if to enable some functionality or not
         *   (eg: show an error if a required 3rd-party plugin is not active,
         *   or enable a module or not.)
         */
        $bundledExtensionClasses = $bundleExtension->getBundledExtensionClasses();
        foreach ($bundledExtensionClasses as $bundledExtensionClass) {
            $this->bundledExtensionClassBundlingExtensionClasses[$bundledExtensionClass] = $bundleExtension;
        }

        return $extension;
    }

    /**
     * Validate that the extension can be registered:
     *
     * 1. It hasn't been registered yet (eg: the plugin is not duplicated)
     * 2. The required version of the main plugin is the one installed
     *
     * If the assertion fails, it prints an error on the WP admin and returns false
     *
     * @param string $mainPluginVersionConstraint the semver version constraint required for the plugin (eg: "^1.0" means >=1.0.0 and <2.0.0)
     * @return bool `true` if the extension can be registered, `false` otherwise
     *
     * @see https://getcomposer.org/doc/articles/versions.md#versions-and-constraints
     */
    public function assertIsValid(string $extensionClass, string $extensionVersion, string $extensionName, string $mainPluginVersionConstraint): bool
    {
        // Validate that the extension is not registered yet.
        if (isset($this->extensionClassInstances[$extensionClass])) {
            /**
             * Check if the installed and new versions are the same.
             * In that case, it may be that the Extension and a
             * Bundle containing that same Extension are installed. In that
             * case, just ignore the error message, and do nothing.
             */
            $installedExtensionVersion = $this->extensionClassInstances[$extensionClass]->getPluginVersion();
            if ($installedExtensionVersion !== $extensionVersion) {
                $errorMessage = sprintf(
                    /*\__(*/                    'Extension <strong>%s</strong> is already installed with version <code>%s</code>, so version <code>%s</code> has not been loaded. Please deactivate all versions, remove the older version, and activate again the latest version of the plugin.'/*, 'gatographql')*/,
                    $extensionName,
                    $installedExtensionVersion,
                    $extensionVersion,
                );
                $this->printAdminNoticeErrorMessage($errorMessage);
            }
            return false;
        }
        /**
         * Validate that the required version of the Gato GraphQL for WP plugin is installed.
         */
        $mainPlugin = PluginApp::getMainPluginManager()->getPlugin();
        $mainPluginVersion = $mainPlugin->getPluginVersion();
        if (
            $mainPluginVersionConstraint !== null && !SemverWrapper::satisfies(
                $mainPluginVersion,
                $mainPluginVersionConstraint
            )
        ) {
            $this->printAdminNoticeErrorMessage(
                sprintf(
                    /*\__(*/                    'Plugin <strong>%1$s</strong> requires <strong>%2$s</strong> to satisfy version constraint <code>%3$s</code>, but the current version <code>%4$s</code> does not. The plugin has not been loaded.<br/>(If you have just updated <strong>%2$s</strong>, notice that the corresponding version for <strong>%1$s</strong> will be already available; please <a href="%5$s" target="_blank">download it%6$s</a> and install it.)'/*, 'gatographql')*/,
                    $extensionName,
                    $mainPlugin->getPluginName(),
                    $mainPluginVersionConstraint,
                    $mainPlugin->getPluginVersion(),
                    /**
                     * Allow for standalone plugins to have their own Shop
                     */
                    sprintf(
                        '%s/shop/my-orders',
                        $mainPlugin->getPluginDomainURL()
                    ),
                    HTMLCodes::OPEN_IN_NEW_WINDOW,
                )
            );
            return false;
        }
        return true;
    }

    /**
     * Validate that the depended-upon extension has the required
     * version constraint.
     *
     * Eg: "Access Control Visitor IP" v9.0.0 will require
     * "Access Control" with constraint "~9.0.0"
     *
     * @param string $dependedUponExtensionVersionConstraint the semver version constraint required for the plugin (eg: "^1.0" means >=1.0.0 and <2.0.0)
     * @param class-string<ExtensionInterface> $dependedUponExtensionClass
     * @return bool `true` if the extension can be registered, `false` otherwise
     *
     * @see https://getcomposer.org/doc/articles/versions.md#versions-and-constraints
     */
    public function assertDependedUponExtensionIsValid(string $extensionName, string $dependedUponExtensionClass, string $dependedUponExtensionVersionConstraint): bool
    {
        // Validate that the depended-upon extension has been registered.
        if (!isset($this->extensionClassInstances[$dependedUponExtensionClass])) {
            $this->printAdminNoticeErrorMessage(
                sprintf(
                    /*\__(*/                    'Extension <strong>%1$s</strong> depends on extension with class <strong>%2$s</strong> to be installed and active, but it is not. The extension has not been loaded.'/*, 'gatographql')*/,
                    $extensionName,
                    $dependedUponExtensionClass,
                )
            );
            return false;
        }
        /**
         * Validate that the required version of the depended-upon extension is installed.
         */
        $dependedUponExtension = $this->getExtension($dependedUponExtensionClass);
        $dependedUponExtensionVersion = $dependedUponExtension->getPluginVersion();
        if (
            $dependedUponExtensionVersionConstraint !== null && !SemverWrapper::satisfies(
                $dependedUponExtensionVersion,
                $dependedUponExtensionVersionConstraint
            )
        ) {
            $this->printAdminNoticeErrorMessage(
                sprintf(
                    /*\__(*/                    'Extension <strong>%1$s</strong> requires <strong>%2$s</strong> to satisfy version constraint <code>%3$s</code>, but the current version <code>%4$s</code> does not. The extension has not been loaded.'/*, 'gatographql')*/,
                    $extensionName,
                    $dependedUponExtension->getPluginName(),
                    $dependedUponExtensionVersionConstraint,
                    $dependedUponExtension->getPluginVersion(),
                )
            );
            return false;
        }
        return true;
    }

    /**
     * Validate that if the main plugin is "-dev", then the extension also is.
     * This is useful to issue licenses for the Marketplace by testing/production,
     * and validate that the corresponding extension is installed.
     */
    public function assertIsSameEnvironmentAsMainPlugin(string $extensionClass, string $extensionVersion, ?string $extensionName = null): bool
    {
        /**
         * Validate that the required version of the Gato GraphQL for WP plugin is installed.
         */
        $mainPlugin = PluginApp::getMainPluginManager()->getPlugin();
        $mainPluginVersion = $mainPlugin->getPluginVersion();
        $errorMessagePlaceholder = 'Plugin <strong>%s</strong> is on "%s" mode, but Extension <strong>%s</strong> is on "%s" mode. They must both be the same. The extension has not been loaded.';
        if (PluginVersionHelpers::isDevelopmentVersion($mainPluginVersion) && !PluginVersionHelpers::isDevelopmentVersion($extensionVersion)) {
            $this->printAdminNoticeErrorMessage(
                sprintf(
                    $errorMessagePlaceholder,
                    $mainPlugin->getPluginName(),
                    'development',
                    $extensionName ?? $extensionClass,
                    'production',
                )
            );
            return false;
        }
        if (!PluginVersionHelpers::isDevelopmentVersion($mainPluginVersion) && PluginVersionHelpers::isDevelopmentVersion($extensionVersion)) {
            $this->printAdminNoticeErrorMessage(
                sprintf(
                    $errorMessagePlaceholder,
                    $mainPlugin->getPluginName(),
                    'production',
                    $extensionName ?? $extensionClass,
                    'development',
                )
            );
            return false;
        }
        return true;
    }

    /**
     * Register the depended-upon plugin main file(s), so that
     * when the plugin is activated, the container is regenerated
     *
     * @param string[] $inactiveExtensionDependedUponPluginFiles
     */
    public function registerInactiveExtensionDependedUponPluginFiles(array $inactiveExtensionDependedUponPluginFiles): void
    {
        $this->inactiveExtensionDependedUponPluginFiles = array_merge(
            $this->inactiveExtensionDependedUponPluginFiles,
            $inactiveExtensionDependedUponPluginFiles
        );
    }

    /**
     * Plugin main files that need to be activated in order
     * for some Gato GraphQL extension to become active.
     *
     * @return string[]
     */
    public function getInactiveExtensionsDependedUponPluginFiles(): array
    {
        return $this->inactiveExtensionDependedUponPluginFiles;
    }

    /**
     * Register the depended-upon theme main file(s), so that
     * when the theme is activated, the container is regenerated
     *
     * @param string[] $inactiveExtensionDependedUponThemeSlugs
     */
    public function registerInactiveExtensionDependedUponThemeFiles(array $inactiveExtensionDependedUponThemeSlugs): void
    {
        $this->inactiveExtensionDependedUponThemeSlugs = array_merge(
            $this->inactiveExtensionDependedUponThemeSlugs,
            $inactiveExtensionDependedUponThemeSlugs
        );
    }

    /**
     * Theme theme slugs that need to be activated in order
     * for some Gato GraphQL extension to become active.
     *
     * @return string[]
     */
    public function getInactiveExtensionsDependedUponThemeSlugs(): array
    {
        return $this->inactiveExtensionDependedUponThemeSlugs;
    }

    public function isExtensionBundled(string $bundledExtensionClass): bool
    {
        return $this->getBundlingExtension($bundledExtensionClass) !== null;
    }

    public function getBundlingExtension(string $bundledExtensionClass): ?BundleExtensionInterface
    {
        return $this->bundledExtensionClassBundlingExtensionClasses[$bundledExtensionClass] ?? null;
    }

    /**
     * Validate that the license for the commercial extension
     * has been activated.
     *
     * If it has not, also mark the Extension as "inactivated",
     * to show a message to the admin.
     *
     * Please notice that it receives the $extensionProductName,
     * which is EXACTLY the same name as registered in the
     * Gato Shop. This name is used as an identifier, to
     * validate that the license key belongs to the right extension.
     *
     * @param string $extensionProductName The EXACT name as the product is stored in the Gato Shop (i.e. in the Marketplace Provider's system)
     * @param array<string,mixed> $options
     */
    public function assertCommercialLicenseHasBeenActivated(string $extensionFile, string $extensionProductName, string $extensionName, string $extensionVersion, array $options = []): bool
    {
        $extensionBaseName = plugin_basename($extensionFile);
        $extensionSlug = dirname($extensionBaseName);
        $extensionData = new ActiveLicenseCommercialExtensionData(
            $extensionProductName,
            $extensionName,
            $extensionSlug,
            $extensionBaseName,
            $extensionVersion,
            $options[ExtensionDataOptions::CHANGELOG_URL] ?? '',
        );
        /**
         * Retrieve from the DB which licenses have been activated,
         * and check if this extension is in it
         */
        $commercialExtensionActivatedLicenseObjectProperties = SettingsHelpers::getCommercialExtensionActivatedLicenseObjectProperties();
        if (!isset($commercialExtensionActivatedLicenseObjectProperties[$extensionSlug])) {
            $this->showAdminWarningNotice($extensionName);
            $this->nonActivatedLicenseCommercialExtensionSlugDataEntries[$extensionSlug] = $extensionData;
            return false;
        }
        $extensionCommercialExtensionActivatedLicenseObjectProperties = $commercialExtensionActivatedLicenseObjectProperties[$extensionSlug];
        /**
         * Check that the license status is valid to use the plugin:
         *
         * - Active: Plugin has been activated, is currently within subscription period
         * - Expired: Subscription has expired, but users can keep using the plugin
         *
         * Notice: With LemonSqueezy as the Marketplace provider, this code will
         * in practice never be invoked, as both the "invalid" and "disabled" status
         * will also produce an "error" in the response, and so the entry will not
         * be stored in the DB. But keep this code for if the Marketplace Provider
         * is ever replaced.
         */
        if (
            !in_array($extensionCommercialExtensionActivatedLicenseObjectProperties->status, [
            LicenseStatus::ACTIVE,
            LicenseStatus::EXPIRED,
            ])
        ) {
            $this->showAdminWarningNotice(
                $extensionName,
                'invalid',
            );
            $this->nonActivatedLicenseCommercialExtensionSlugDataEntries[$extensionSlug] = $extensionData;
            return false;
        }
        /**
         * Make sure the activated plugin is the corresponding one to the license.
         */
        if ($extensionCommercialExtensionActivatedLicenseObjectProperties->productName !== $extensionProductName) {
            $this->showAdminWarningNotice(
                $extensionName,
                'unmatching',
            );
            $this->nonActivatedLicenseCommercialExtensionSlugDataEntries[$extensionSlug] = $extensionData;
            return false;
        }
        // Everything is good!
        $this->activatedLicenseCommercialExtensionSlugDataEntries[$extensionSlug] = $extensionData;
        return true;
    }

    /**
     * Unless we are in the Settings page, show a warning about activating the extension
     */
    protected function showAdminWarningNotice(string $extensionName, ?string $messagePlaceholderCode = null): void
    {
        \add_action('admin_notices', function () use ($extensionName, $messagePlaceholderCode) {
            switch ($messagePlaceholderCode) {
                case 'invalid':
                    $messagePlaceholder = __('The license is invalid. Please <a href="%s">enter a new license key in %s</a> to enable it', 'gatographql');
                    break;
                case 'unmatching':
                    $messagePlaceholder = __('The provided license key belongs to a different extension. Please <a href="%s">enter the right license key in %s</a> to enable it', 'gatographql');
                    break;
                default:
                    $messagePlaceholder = __('Please <a href="%s">enter the license key in %s</a> to enable it', 'gatographql');
                    break;
            }

            // /**
            //  * Do not print the warnings in the Settings page
            //  */
            // $instanceManager = InstanceManagerFacade::getInstance();
            // /** @var SettingsMenuPage */
            // $settingsMenuPage = $instanceManager->getInstance(SettingsMenuPage::class);
            // if (App::query('page') === $settingsMenuPage->getScreenID()) {
            //     return;
            // }
            $moduleRegistry = ModuleRegistryFacade::getInstance();
            $settingsCategoryRegistry = SettingsCategoryRegistryFacade::getInstance();
            $activateExtensionsModule = PluginManagementFunctionalityModuleResolver::ACTIVATE_EXTENSIONS;
            $pluginManagementSettingsCategory = SettingsCategoryResolver::PLUGIN_MANAGEMENT;
            $activateExtensionsModuleResolver = $moduleRegistry->getModuleResolver($activateExtensionsModule);
            $instanceManager = InstanceManagerFacade::getInstance();
            /** @var SettingsMenuPage */
            $settingsMenuPage = $instanceManager->getInstance(SettingsMenuPage::class);
            $adminNotice_safe = sprintf(
                '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
                sprintf(
                    __('<strong>%s</strong>: %s.', 'gatographql'),
                    PluginStaticModuleConfiguration::displayGatoGraphQLPROBundleOnExtensionsPage() && !PluginStaticModuleConfiguration::displayGatoGraphQLPROFeatureBundlesOnExtensionsPage()
                        ? __('Gato GraphQL PRO', 'gatographql')
                        : $extensionName,
                    sprintf(
                        $messagePlaceholder,
                        AdminHelpers::getSettingsPageTabURL($activateExtensionsModule),
                        sprintf(
                            '<code>%s > %s > %s</code>',
                            $settingsMenuPage->getMenuPageTitle(),
                            $settingsCategoryRegistry->getSettingsCategoryResolver($pluginManagementSettingsCategory)->getName($pluginManagementSettingsCategory),
                            $activateExtensionsModuleResolver->getName($activateExtensionsModule),
                        )
                    )
                )
            );
            echo $adminNotice_safe;
        });
    }

    /**
     * @return array<string,ActiveLicenseCommercialExtensionData> Extension Slug => ActiveLicenseCommercialExtensionData
     */
    public function getNonActivatedLicenseCommercialExtensionSlugDataEntries(): array
    {
        return $this->nonActivatedLicenseCommercialExtensionSlugDataEntries;
    }

    /**
     * @return array<string,ActiveLicenseCommercialExtensionData> Extension Slug => ActiveLicenseCommercialExtensionData
     */
    public function getActivatedLicenseCommercialExtensionSlugDataEntries(): array
    {
        return $this->activatedLicenseCommercialExtensionSlugDataEntries;
    }

    /**
     * Call this method only after calling `assertCommercialLicenseHasBeenActivated`
     */
    public function isExtensionLicenseActive(string $extensionSlug): bool
    {
        return isset($this->activatedLicenseCommercialExtensionSlugDataEntries[$extensionSlug]);
    }

    /**
     * @return array<string,string> Extension Slug => Extension Product Name
     */
    public function getCommercialExtensionSlugProductNames(): array
    {
        if ($this->commercialExtensionSlugProductNames === null) {
            $this->commercialExtensionSlugProductNames = array_map(
                function (ActiveLicenseCommercialExtensionData $extensionData) {
                    return $extensionData->productName;
                },
                array_merge(
                    $this->getNonActivatedLicenseCommercialExtensionSlugDataEntries(),
                    $this->getActivatedLicenseCommercialExtensionSlugDataEntries()
                ),
            );
            ksort($this->commercialExtensionSlugProductNames);
        }
        return $this->commercialExtensionSlugProductNames;
    }
}
