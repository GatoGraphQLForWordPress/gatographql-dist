<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\Marketplace\ObjectModels;

use GatoGraphQL\GatoGraphQL\PluginSkeleton\PluginInterface;

class CommercialPluginUpdatedPluginData
{
    /**
     * @readonly
     * @var \GatoGraphQL\GatoGraphQL\PluginSkeleton\PluginInterface
     */
    public $plugin;
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
    public function __construct(PluginInterface $plugin, string $licenseKey, string $cacheKey)
    {
        $this->plugin = $plugin;
        $this->licenseKey = $licenseKey;
        $this->cacheKey = $cacheKey;
    }
}
