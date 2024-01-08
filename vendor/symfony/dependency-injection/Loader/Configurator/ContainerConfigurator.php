<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PrefixedByPoP\Symfony\Component\DependencyInjection\Loader\Configurator;

use PrefixedByPoP\Symfony\Component\Config\Loader\ParamConfigurator;
use PrefixedByPoP\Symfony\Component\DependencyInjection\Argument\AbstractArgument;
use PrefixedByPoP\Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use PrefixedByPoP\Symfony\Component\DependencyInjection\Argument\ServiceLocatorArgument;
use PrefixedByPoP\Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use PrefixedByPoP\Symfony\Component\DependencyInjection\ContainerBuilder;
use PrefixedByPoP\Symfony\Component\DependencyInjection\Definition;
use PrefixedByPoP\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use PrefixedByPoP\Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use PrefixedByPoP\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use PrefixedByPoP\Symfony\Component\ExpressionLanguage\Expression;
/**
 * @author Nicolas Grekas <p@tchwork.com>
 * @internal
 */
class ContainerConfigurator extends AbstractConfigurator
{
    public const FACTORY = 'container';
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    private $container;
    /**
     * @var \Symfony\Component\DependencyInjection\Loader\PhpFileLoader
     */
    private $loader;
    /**
     * @var mixed[]
     */
    private $instanceof;
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $file;
    /**
     * @var int
     */
    private $anonymousCount = 0;
    /**
     * @var string|null
     */
    private $env;
    public function __construct(ContainerBuilder $container, PhpFileLoader $loader, array &$instanceof, string $path, string $file, string $env = null)
    {
        $this->container = $container;
        $this->loader = $loader;
        $this->instanceof =& $instanceof;
        $this->path = $path;
        $this->file = $file;
        $this->env = $env;
    }
    public final function extension(string $namespace, array $config) : void
    {
        if (!$this->container->hasExtension($namespace)) {
            $extensions = \array_filter(\array_map(function (ExtensionInterface $ext) {
                return $ext->getAlias();
            }, $this->container->getExtensions()));
            throw new InvalidArgumentException(\sprintf('There is no extension able to load the configuration for "%s" (in "%s"). Looked for namespace "%s", found "%s".', $namespace, $this->file, $namespace, $extensions ? \implode('", "', $extensions) : 'none'));
        }
        $this->container->loadFromExtension($namespace, static::processValue($config));
    }
    /**
     * @param bool|string $ignoreErrors
     */
    public final function import(string $resource, string $type = null, $ignoreErrors = \false) : void
    {
        $this->loader->setCurrentDir(\dirname($this->path));
        $this->loader->import($resource, $type, $ignoreErrors, $this->file);
    }
    public final function parameters() : ParametersConfigurator
    {
        return new ParametersConfigurator($this->container);
    }
    public final function services() : ServicesConfigurator
    {
        return new ServicesConfigurator($this->container, $this->loader, $this->instanceof, $this->path, $this->anonymousCount);
    }
    /**
     * Get the current environment to be able to write conditional configuration.
     */
    public final function env() : ?string
    {
        return $this->env;
    }
    /**
     * @return static
     */
    public final function withPath(string $path)
    {
        $clone = clone $this;
        $clone->path = $clone->file = $path;
        $clone->loader->setCurrentDir(\dirname($path));
        return $clone;
    }
}
/**
 * Creates a parameter.
 * @internal
 */
function param(string $name) : ParamConfigurator
{
    return new ParamConfigurator($name);
}
/**
 * Creates a reference to a service.
 * @internal
 */
function service(string $serviceId) : ReferenceConfigurator
{
    return new ReferenceConfigurator($serviceId);
}
/**
 * Creates an inline service.
 * @internal
 */
function inline_service(string $class = null) : InlineServiceConfigurator
{
    return new InlineServiceConfigurator(new Definition($class));
}
/**
 * Creates a service locator.
 *
 * @param array<ReferenceConfigurator|InlineServiceConfigurator> $values
 * @internal
 */
function service_locator(array $values) : ServiceLocatorArgument
{
    $values = AbstractConfigurator::processValue($values, \true);
    if (isset($values[0])) {
        trigger_deprecation('symfony/dependency-injection', '6.3', 'Using integers as keys in a "service_locator()" argument is deprecated. The keys will default to the IDs of the original services in 7.0.');
    }
    return new ServiceLocatorArgument($values);
}
/**
 * Creates a lazy iterator.
 *
 * @param ReferenceConfigurator[] $values
 * @internal
 */
function iterator(array $values) : IteratorArgument
{
    return new IteratorArgument(AbstractConfigurator::processValue($values, \true));
}
/**
 * Creates a lazy iterator by tag name.
 * @param string|mixed[] $exclude
 * @internal
 */
function tagged_iterator(string $tag, string $indexAttribute = null, string $defaultIndexMethod = null, string $defaultPriorityMethod = null, $exclude = [], bool $excludeSelf = \true) : TaggedIteratorArgument
{
    return new TaggedIteratorArgument($tag, $indexAttribute, $defaultIndexMethod, \false, $defaultPriorityMethod, (array) $exclude, $excludeSelf);
}
/**
 * Creates a service locator by tag name.
 * @param string|mixed[] $exclude
 * @internal
 */
function tagged_locator(string $tag, string $indexAttribute = null, string $defaultIndexMethod = null, string $defaultPriorityMethod = null, $exclude = [], bool $excludeSelf = \true) : ServiceLocatorArgument
{
    return new ServiceLocatorArgument(new TaggedIteratorArgument($tag, $indexAttribute, $defaultIndexMethod, \true, $defaultPriorityMethod, (array) $exclude, $excludeSelf));
}
/**
 * Creates an expression.
 * @internal
 */
function expr(string $expression) : Expression
{
    return new Expression($expression);
}
/**
 * Creates an abstract argument.
 * @internal
 */
function abstract_arg(string $description) : AbstractArgument
{
    return new AbstractArgument($description);
}
/**
 * Creates an environment variable reference.
 * @internal
 */
function env(string $name) : EnvConfigurator
{
    return new EnvConfigurator($name);
}
/**
 * Creates a closure service reference.
 * @internal
 */
function service_closure(string $serviceId) : ClosureReferenceConfigurator
{
    return new ClosureReferenceConfigurator($serviceId);
}
/**
 * Creates a closure.
 * @param string|mixed[]|\Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator|\Symfony\Component\ExpressionLanguage\Expression $callable
 * @internal
 */
function closure($callable) : InlineServiceConfigurator
{
    return (new InlineServiceConfigurator(new Definition('Closure')))->factory(['Closure', 'fromCallable'])->args([$callable]);
}
