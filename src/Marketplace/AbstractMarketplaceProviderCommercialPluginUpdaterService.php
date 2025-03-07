<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Marketplace;

use GatoGraphQL\GatoGraphQL\Marketplace\ObjectModels\CommercialPluginUpdatedPluginData;
use GatoGraphQL\GatoGraphQL\PluginApp;
use PoP\Root\Exception\ShouldNotHappenException;
use PoP\Root\Services\AbstractBasicService;
use stdClass;
use WP_Upgrader;
use WP_Error;

use function add_action;
use function add_filter;
use function delete_transient;
use function get_transient;
use function is_wp_error;
use function set_transient;
use function wp_remote_retrieve_body;
use function wp_remote_retrieve_response_code;

/**
 * Copied code from `Make-Lemonade/lemonsqueezy-wp-updater-example`
 *
 * @see https://github.com/Make-Lemonade/lemonsqueezy-wp-updater-example
 * @see https://github.com/Make-Lemonade/lemonsqueezy-wp-updater-example/blob/7c0c71876309939b07d96e270f4db8568f3148cb/includes/class-plugin-updater.php
 */
abstract class AbstractMarketplaceProviderCommercialPluginUpdaterService extends AbstractBasicService implements MarketplaceProviderCommercialPluginUpdaterServiceInterface
{
    /**
     * @var bool
     */
    protected $initialized = false;

    /**
     * @var array<string,CommercialPluginUpdatedPluginData> Key: plugin slug, Value: CommercialPluginUpdatedPluginData
     */
    protected $pluginSlugDataEntries = [];

    /**
     * Only disable this for debugging
     * @var bool
     */
    protected $cacheAllowed = true;

    /**
     * Use the Marketplace provider's service to
     * update the active commercial extensions
     *
     * @param array<string,string> $licenseKeys Key: Extension Slug, Value: License Key
     *
     * @throws ShouldNotHappenException If initializing the service more than once
     */
    public function setupMarketplacePluginUpdaterForExtensions(array $licenseKeys): void
    {
        if ($this->initialized) {
            throw new ShouldNotHappenException('This service must not be initialized more than once');
        }
        $this->initialized = true;
        if ($licenseKeys === []) {
            return;
        }
        /**
         * Generate the entries for all the commercial plugins,
         * possibly including the main Plugin too.
         *
         * Notice there's no need to include the mainPlugin,
         * because even with commercial Standalone Plugins,
         * they include an Extension class inside. (And currently,
         * `isCommercial` belongs to `Extension`, not `Plugin`)
         */
        $extensionManager = PluginApp::getExtensionManager();
        $activeExtensionDataEntries = $extensionManager->getActivatedLicenseCommercialExtensionSlugDataEntries();
        foreach ($licenseKeys as $pluginSlug => $pluginLicenseKey) {
            $activeExtensionData = $activeExtensionDataEntries[$pluginSlug] ?? null;
            if ($activeExtensionData === null) {
                continue;
            }
            $this->pluginSlugDataEntries[$pluginSlug] = new CommercialPluginUpdatedPluginData(
                $activeExtensionData->name,
                $activeExtensionData->slug,
                $activeExtensionData->baseName,
                $activeExtensionData->version,
                $activeExtensionData->changelogURL,
                $pluginLicenseKey,
                str_replace('-', '_', $pluginSlug) . '_updater',
            );
        }
        add_filter('plugins_api', \Closure::fromCallable([$this, 'overridePluginInfo']), 20, 3);
        add_filter('site_transient_update_plugins', \Closure::fromCallable([$this, 'overridePluginUpdate']));
        add_action('upgrader_process_complete', \Closure::fromCallable([$this, 'overridePluginPurge']), 10, 2);
    }

    abstract protected function providePluginUpdatesAPIURL(string $pluginUpdatesServerURL): string;

    /**
     * Override the WordPress request to return the correct plugin info.
     *
     * @see https://developer.wordpress.org/reference/hooks/plugins_api/
     *
     * @param false|object|array<string,mixed> $result
     * @return false|object|array<string,mixed>
     */
    public function overridePluginInfo(
        $result,
        string $action,
        object $args
    ) {
        if ($action !== 'plugin_information') {
            return $result;
        }

        /** @var string|null */
        $pluginSlug = $args->slug ?? null;
        if ($pluginSlug === null) {
            return $result;
        }
        $pluginData = $this->pluginSlugDataEntries[$pluginSlug] ?? null;
        if ($pluginData === null) {
            return $result;
        }

        $remote = $this->requestPluginDataFromServer($pluginData);
        if (!$remote || !($remote->success ?? null) || empty($remote->update)) {
            return $result;
        }

        $result       = $remote->update;
        $result->name = $pluginData->pluginName;
        $result->slug = $pluginData->pluginSlug;
        $result->sections = (array) $result->sections;

        return $result;
    }

    /**
     * Fetch the update info from the remote server running the Marketplace provider's plugin.
     * @return object|bool
     */
    protected function requestPluginDataFromServer(CommercialPluginUpdatedPluginData $pluginData)
    {
        $remote = get_transient($pluginData->cacheKey);
        if ($remote !== false && $this->cacheAllowed) {
            if ($remote === 'error') {
                return false;
            }

            return json_decode($remote);
        }

        $remote = $this->getRemotePluginData($pluginData);

        if (
            is_wp_error($remote)
            || wp_remote_retrieve_response_code($remote) !== 200
            || empty(wp_remote_retrieve_body($remote))
        ) {
            set_transient($pluginData->cacheKey, 'error', MINUTE_IN_SECONDS * 10);
            return false;
        }

        $payload = wp_remote_retrieve_body($remote);
        set_transient($pluginData->cacheKey, $payload, DAY_IN_SECONDS);
        return json_decode($payload);
    }

    /**
     * Fetch the update info from the remote server running the Marketplace provider's plugin.
     *
     * @return array<string,mixed>|WP_Error
     */
    abstract protected function getRemotePluginData(CommercialPluginUpdatedPluginData $pluginData);

    /**
     * Override the WordPress request to check if an update is available.
     *
     * @see https://make.wordpress.org/core/2020/07/30/recommended-usage-of-the-updates-api-to-support-the-auto-updates-ui-for-plugins-and-themes-in-wordpress-5-5/
     * @param \stdClass|false $transient
     * @return object|false
     */
    public function overridePluginUpdate($transient)
    {
        if ($transient === false || empty($transient->checked)) {
            return $transient;
        }

        foreach ($this->pluginSlugDataEntries as $pluginData) {
            $res = (object) array(
                'id'            => $pluginData->pluginBaseName,
                /**
                 * If providing the slug, the plugin item in the Plugins page
                 * will have link "View details", which produces an error,
                 * instead of the expected "Visit plugin site"
                 */
                'slug'          => null,//$pluginData->pluginSlug,
                'plugin'        => $pluginData->pluginBaseName,
                'new_version'   => $pluginData->pluginVersion,
                'url'           => $pluginData->pluginChangelogURL,
                'package'       => '',
                'icons'         => [
                    // For each extension, use the same icon as the Gato GraphQL plugin
                    'default' => 'https://ps.w.org/gatographql/assets/icon-256x256.png',
                ],
                'banners'       => [],
                'banners_rtl'   => [],
                'tested'        => '',
                'requires_php'  => '',
                'compatibility' => new stdClass(),
            );

            $remote = $this->requestPluginDataFromServer($pluginData);

            if (
                $remote && ($remote->success ?? null) && !empty($remote->update)
                && version_compare($pluginData->pluginVersion, $remote->update->version, '<')
            ) {
                $res->new_version = $remote->update->version;
                $res->package     = $remote->update->download_link;

                $transient->response = $transient->response ?? [];
                $transient->response[$res->plugin] = $res;
            } else {
                $transient->no_update = $transient->no_update ?? [];
                $transient->no_update[$res->plugin] = $res;
            }
        }

        return $transient;
    }

    /**
     * When the update is complete, purge the cache.
     *
     * @see https://developer.wordpress.org/reference/hooks/upgrader_process_complete/
     *
     * @param array<string,mixed> $options
     */
    public function overridePluginPurge(WP_Upgrader $upgrader, array $options): void
    {
        if (
            !$this->cacheAllowed
            || ($options['action'] ?? null) !== 'update'
            || ($options['type'] ?? null) !== 'plugin'
            || empty($options['plugins'])
        ) {
            return;
        }

        /** @var string[] */
        $pluginIDs = $options['plugins'];
        foreach ($pluginIDs as $pluginID) {
            foreach ($this->pluginSlugDataEntries as $pluginData) {
                if ($pluginID !== $pluginData->pluginBaseName) {
                    continue;
                }
                delete_transient($pluginData->cacheKey);
                break;
            }
        }
    }
}
