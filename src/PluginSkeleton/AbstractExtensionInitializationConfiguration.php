<?php

declare(strict_types=1);

namespace GatoGraphQL\GatoGraphQL\PluginSkeleton;

/**
 * Base class to set the configuration in all the PoP components for the Extension.
 */
abstract class AbstractExtensionInitializationConfiguration extends AbstractPluginInitializationConfiguration implements ExtensionInitializationConfigurationInterface
{
    /**
     * @var \GatoGraphQL\GatoGraphQL\PluginSkeleton\ExtensionInterface
     */
    protected $extension;
    public function __construct(ExtensionInterface $extension)
    {
        $this->extension = $extension;
    }
}
