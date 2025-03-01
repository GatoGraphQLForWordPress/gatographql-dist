<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Compiler;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\ContainerBuilder;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Reference;
/** @internal */
final class AliasDeprecatedPublicServicesPass extends AbstractRecursivePass
{
    /**
     * @var bool
     */
    protected $skipScalars = \true;
    /**
     * @var mixed[]
     */
    private $aliases = [];
    public function process(ContainerBuilder $container) : void
    {
        foreach ($container->findTaggedServiceIds('container.private') as $id => $tags) {
            if (null === ($package = $tags[0]['package'] ?? null)) {
                throw new InvalidArgumentException(\sprintf('The "package" attribute is mandatory for the "container.private" tag on the "%s" service.', $id));
            }
            if (null === ($version = $tags[0]['version'] ?? null)) {
                throw new InvalidArgumentException(\sprintf('The "version" attribute is mandatory for the "container.private" tag on the "%s" service.', $id));
            }
            $definition = $container->getDefinition($id);
            if (!$definition->isPublic() || $definition->isPrivate()) {
                continue;
            }
            $container->setAlias($id, $aliasId = '.container.private.' . $id)->setPublic(\true)->setDeprecated($package, $version, 'Accessing the "%alias_id%" service directly from the container is deprecated, use dependency injection instead.');
            $container->setDefinition($aliasId, $definition);
            $this->aliases[$id] = $aliasId;
        }
        parent::process($container);
    }
    /**
     * @param mixed $value
     * @return mixed
     */
    protected function processValue($value, bool $isRoot = \false)
    {
        if ($value instanceof Reference && isset($this->aliases[$id = (string) $value])) {
            return new Reference($this->aliases[$id], $value->getInvalidBehavior());
        }
        return parent::processValue($value, $isRoot);
    }
}
