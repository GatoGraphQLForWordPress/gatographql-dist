<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Marketplace\ObjectModels;

class CommercialPluginUpdatedPluginData
{
    /**
     * @readonly
     * @var string
     */
    public $pluginName;
    /**
     * @readonly
     * @var string
     */
    public $pluginSlug;
    /**
     * @readonly
     * @var string
     */
    public $pluginBaseName;
    /**
     * @readonly
     * @var string
     */
    public $pluginVersion;
    /**
     * @readonly
     * @var string
     */
    public $licenseKey;
    /**
     * @readonly
     * @var string
     */
    public $cacheKey;
    public function __construct(string $pluginName, string $pluginSlug, string $pluginBaseName, string $pluginVersion, string $licenseKey, string $cacheKey)
    {
        $this->pluginName = $pluginName;
        $this->pluginSlug = $pluginSlug;
        $this->pluginBaseName = $pluginBaseName;
        $this->pluginVersion = $pluginVersion;
        $this->licenseKey = $licenseKey;
        $this->cacheKey = $cacheKey;
    }
}
