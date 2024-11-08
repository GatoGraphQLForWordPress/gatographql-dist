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
     * @var string
     * @readonly
     */
    private $applicationName;
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
     * @param string $applicationName Needed to store the container with a unique classname, to avoid conflict whenever 2 or more applications (each with its own container caching) are running.
     * @param boolean|null $cacheContainerConfiguration Indicate if to cache the container. If null, it gets the value from ENV
     * @param string|null $containerConfigurationCacheNamespace Provide the namespace, to regenerate the cache whenever the application is upgraded. If null, it gets the value from ENV
     * @param string|null $containerConfigurationCacheDirectory Provide the directory, to regenerate the cache whenever the application is upgraded. If null, it uses the default /tmp folder by the OS
     */
    public function __construct(string $applicationName, ?bool $cacheContainerConfiguration = null, ?string $containerConfigurationCacheNamespace = null, ?string $containerConfigurationCacheDirectory = null)
    {
        $this->applicationName = $applicationName;
        $this->cacheContainerConfiguration = $cacheContainerConfiguration;
        $this->containerConfigurationCacheNamespace = $containerConfigurationCacheNamespace;
        $this->containerConfigurationCacheDirectory = $containerConfigurationCacheDirectory;
    }
    public function getApplicationName() : string
    {
        return $this->applicationName;
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
