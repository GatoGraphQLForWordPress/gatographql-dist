<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Exception\LogicException;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\ExpressionLanguage\ExpressionFunction;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
/**
 * Define some ExpressionLanguage functions.
 *
 * To get a service, use service('request').
 * To get a parameter, use parameter('kernel.debug').
 * To get an env variable, use env('SOME_VARIABLE').
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @internal
 */
class ExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @var \Closure|null
     */
    private $serviceCompiler;
    /**
     * @var \Closure|null
     */
    private $getEnv;
    public function __construct(?callable $serviceCompiler = null, ?\Closure $getEnv = null)
    {
        $this->serviceCompiler = null === $serviceCompiler ? null : \Closure::fromCallable($serviceCompiler);
        $this->getEnv = $getEnv;
    }
    public function getFunctions() : array
    {
        return [new ExpressionFunction('service', $this->serviceCompiler ?? function ($arg) {
            return \sprintf('$container->get(%s)', $arg);
        }, function (array $variables, $value) {
            return $variables['container']->get($value);
        }), new ExpressionFunction('parameter', function ($arg) {
            return \sprintf('$container->getParameter(%s)', $arg);
        }, function (array $variables, $value) {
            return $variables['container']->getParameter($value);
        }), new ExpressionFunction('env', function ($arg) {
            return \sprintf('$container->getEnv(%s)', $arg);
        }, function (array $variables, $value) {
            if (!$this->getEnv) {
                throw new LogicException('You need to pass a getEnv closure to the expression language provider to use the "env" function.');
            }
            return ($this->getEnv)($value);
        }), new ExpressionFunction('arg', function ($arg) {
            return \sprintf('$args?->get(%s)', $arg);
        }, function (array $variables, $value) {
            return ($nullsafeVariable1 = $variables['args']) ? $nullsafeVariable1->get($value) : null;
        })];
    }
}
