<?php

declare (strict_types=1);
namespace PoP\Root\Container\Loader;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Config\FileLocatorInterface;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\ContainerBuilder;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
/**
 * Override the Symfony class, to:
 *
 * - always inject the "autoconfigure" property
 * - add the required tag "container.ignore_attributes" to avoid PHP 8's attributes
 * @internal
 */
class SchemaServiceYamlFileLoader extends YamlFileLoader
{
    /**
     * @var bool
     */
    protected $autoconfigure;
    use \PoP\Root\Container\Loader\ServiceYamlFileLoaderTrait;
    public function __construct(ContainerBuilder $container, FileLocatorInterface $locator, bool $autoconfigure)
    {
        $this->autoconfigure = $autoconfigure;
        parent::__construct($container, $locator);
    }
    /**
     * @return mixed[]|null
     */
    protected function loadFile(string $file) : ?array
    {
        $content = parent::loadFile($file);
        if ($content === null) {
            return null;
        }
        $content['services']['_defaults']['autoconfigure'] = $this->autoconfigure;
        return $this->customizeYamlFileDefinition($content);
    }
}
