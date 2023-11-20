<?php

declare (strict_types=1);
namespace PoP\Root\Container;

/**
 * Configuration to cache the container
 * @internal
 */
class ContainerCacheConfiguration
{
    /**
     * @var boolean|null
     * @readonly
     */
    private $cacheContainerConfiguration;
    /**
     * @var string|null
     * @readonly
     */
    private $containerConfigurationCacheNamespace;
    /**
     * @var string|null
     * @readonly
     */
    private $containerConfigurationCacheDirectory;
    /**
     * @param boolean|null $cacheContainerConfiguration Indicate if to cache the container. If null, it gets the value from ENV
     * @param string|null $containerConfigurationCacheNamespace Provide the namespace, to regenerate the cache whenever the application is upgraded. If null, it gets the value from ENV
     * @param string|null $containerConfigurationCacheDirectory Provide the directory, to regenerate the cache whenever the application is upgraded. If null, it uses the default /tmp folder by the OS
     */
    public function __construct(?bool $cacheContainerConfiguration = null, ?string $containerConfigurationCacheNamespace = null, ?string $containerConfigurationCacheDirectory = null)
    {
        $this->cacheContainerConfiguration = $cacheContainerConfiguration;
        $this->containerConfigurationCacheNamespace = $containerConfigurationCacheNamespace;
        $this->containerConfigurationCacheDirectory = $containerConfigurationCacheDirectory;
    }
    public function cacheContainerConfiguration() : ?bool
    {
        return $this->cacheContainerConfiguration;
    }
    public function getContainerConfigurationCacheNamespace() : ?string
    {
        return $this->containerConfigurationCacheNamespace;
    }
    public function getContainerConfigurationCacheDirectory() : ?string
    {
        return $this->containerConfigurationCacheDirectory;
    }
}
