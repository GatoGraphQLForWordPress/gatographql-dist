<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Loader\Configurator;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Definition;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
/**
 * @author Nicolas Grekas <p@tchwork.com>
 * @internal
 */
class PrototypeConfigurator extends AbstractServiceConfigurator
{
    use Traits\AbstractTrait;
    use Traits\ArgumentTrait;
    use Traits\AutoconfigureTrait;
    use Traits\AutowireTrait;
    use Traits\BindTrait;
    use Traits\CallTrait;
    use Traits\ConfiguratorTrait;
    use Traits\ConstructorTrait;
    use Traits\DeprecateTrait;
    use Traits\FactoryTrait;
    use Traits\LazyTrait;
    use Traits\ParentTrait;
    use Traits\PropertyTrait;
    use Traits\PublicTrait;
    use Traits\ShareTrait;
    use Traits\TagTrait;
    public const FACTORY = 'load';
    /**
     * @var \Symfony\Component\DependencyInjection\Loader\PhpFileLoader
     */
    private $loader;
    /**
     * @var string
     */
    private $resource;
    /**
     * @var mixed[]|null
     */
    private $excludes;
    /**
     * @var bool
     */
    private $allowParent;
    /**
     * @var string|null
     */
    private $path;
    public function __construct(ServicesConfigurator $parent, PhpFileLoader $loader, Definition $defaults, string $namespace, string $resource, bool $allowParent, ?string $path = null)
    {
        $definition = new Definition();
        if (!$defaults->isPublic() || !$defaults->isPrivate()) {
            $definition->setPublic($defaults->isPublic());
        }
        $definition->setAutowired($defaults->isAutowired());
        $definition->setAutoconfigured($defaults->isAutoconfigured());
        // deep clone, to avoid multiple process of the same instance in the passes
        $definition->setBindings(\unserialize(\serialize($defaults->getBindings())));
        $definition->setChanges([]);
        $this->loader = $loader;
        $this->resource = $resource;
        $this->allowParent = $allowParent;
        $this->path = $path;
        parent::__construct($parent, $definition, $namespace, $defaults->getTags());
    }
    public function __destruct()
    {
        parent::__destruct();
        if (isset($this->loader)) {
            $this->loader->registerClasses($this->definition, $this->id, $this->resource, $this->excludes, $this->path);
        }
        unset($this->loader);
    }
    /**
     * Excludes files from registration using glob patterns.
     *
     * @param string[]|string $excludes
     *
     * @return $this
     */
    public final function exclude($excludes)
    {
        $this->excludes = (array) $excludes;
        return $this;
    }
}
