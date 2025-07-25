<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Contracts\Service;

use GatoExternalPrefixByGatoGraphQL\Psr\Container\ContainerInterface;
use GatoExternalPrefixByGatoGraphQL\Symfony\Contracts\Service\Attribute\Required;
use GatoExternalPrefixByGatoGraphQL\Symfony\Contracts\Service\Attribute\SubscribedService;
/**
 * Implementation of ServiceSubscriberInterface that determines subscribed services
 * from methods that have the #[SubscribedService] attribute.
 *
 * Service ids are available as "ClassName::methodName" so that the implementation
 * of subscriber methods can be just `return $this->container->get(__METHOD__);`.
 *
 * @author Kevin Bond <kevinbond@gmail.com>
 * @internal
 */
trait ServiceMethodsSubscriberTrait
{
    /**
     * @var \Psr\Container\ContainerInterface
     */
    protected $container;
    public static function getSubscribedServices() : array
    {
        $services = \method_exists(\get_parent_class(self::class) ?: '', __FUNCTION__) ? parent::getSubscribedServices() : [];
        foreach ((new \ReflectionClass(self::class))->getMethods() as $method) {
            if (self::class !== $method->getDeclaringClass()->name) {
                continue;
            }
            if (!($attribute = (\method_exists($method, 'getAttributes') ? $method->getAttributes(SubscribedService::class) : [])[0] ?? null)) {
                continue;
            }
            if ($method->isStatic() || $method->isAbstract() || $method->isGenerator() || $method->isInternal() || $method->getNumberOfRequiredParameters()) {
                throw new \LogicException(\sprintf('Cannot use "%s" on method "%s::%s()" (can only be used on non-static, non-abstract methods with no parameters).', SubscribedService::class, self::class, $method->name));
            }
            if (!($returnType = $method->getReturnType())) {
                throw new \LogicException(\sprintf('Cannot use "%s" on methods without a return type in "%s::%s()".', SubscribedService::class, $method->name, self::class));
            }
            /* @var SubscribedService $attribute */
            $attribute = $attribute->newInstance();
            $attribute->key = $attribute->key ?? self::class . '::' . $method->name;
            $attribute->type = $attribute->type ?? ($returnType instanceof \ReflectionNamedType ? $returnType->getName() : (string) $returnType);
            $attribute->nullable = $attribute->nullable ?: $returnType->allowsNull();
            if ($attribute->attributes) {
                $services[] = $attribute;
            } else {
                $services[$attribute->key] = ($attribute->nullable ? '?' : '') . $attribute->type;
            }
        }
        return $services;
    }
    /**
     * @required
     */
    public function setContainer(ContainerInterface $container) : ?ContainerInterface
    {
        $ret = null;
        if (\method_exists(\get_parent_class(self::class) ?: '', __FUNCTION__)) {
            $ret = parent::setContainer($container);
        }
        $this->container = $container;
        return $ret;
    }
}
