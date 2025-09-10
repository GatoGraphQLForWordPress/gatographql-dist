<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\Config\Definition\Configurator;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Config\Definition\Builder\NodeDefinition;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Config\Definition\Builder\TreeBuilder;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\Config\Definition\Loader\DefinitionFileLoader;
/**
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 * @internal
 */
class DefinitionConfigurator
{
    public function __construct(private TreeBuilder $treeBuilder, private DefinitionFileLoader $loader, private string $path, private string $file)
    {
    }
    public function import(string $resource, ?string $type = null, bool $ignoreErrors = \false) : void
    {
        $this->loader->setCurrentDir(\dirname($this->path));
        $this->loader->import($resource, $type, $ignoreErrors, $this->file);
    }
    public function rootNode() : NodeDefinition|ArrayNodeDefinition
    {
        return $this->treeBuilder->getRootNode();
    }
    public function setPathSeparator(string $separator) : void
    {
        $this->treeBuilder->setPathSeparator($separator);
    }
}
