<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\ParameterBag;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Exception\LogicException;
use GatoExternalPrefixByGatoGraphQL\Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
/**
 * ParameterBagInterface is the interface implemented by objects that manage service container parameters.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @internal
 */
interface ParameterBagInterface
{
    /**
     * Clears all parameters.
     *
     * @return void
     *
     * @throws LogicException if the ParameterBagInterface cannot be cleared
     */
    public function clear();
    /**
     * Adds parameters to the service container parameters.
     *
     * @return void
     *
     * @throws LogicException if the parameter cannot be added
     */
    public function add(array $parameters);
    /**
     * Gets the service container parameters.
     */
    public function all() : array;
    /**
     * Gets a service container parameter.
     *
     * @throws ParameterNotFoundException if the parameter is not defined
     * @return mixed[]|bool|string|int|float|\UnitEnum|null
     */
    public function get(string $name);
    /**
     * Removes a parameter.
     *
     * @return void
     */
    public function remove(string $name);
    /**
     * Sets a service container parameter.
     *
     * @return void
     *
     * @throws LogicException if the parameter cannot be set
     * @param mixed[]|bool|string|int|float|\UnitEnum|null $value
     */
    public function set(string $name, $value);
    /**
     * Returns true if a parameter name is defined.
     */
    public function has(string $name) : bool;
    /**
     * Replaces parameter placeholders (%name%) by their values for all parameters.
     *
     * @return void
     */
    public function resolve();
    /**
     * Replaces parameter placeholders (%name%) by their values.
     *
     * @return mixed
     *
     * @throws ParameterNotFoundException if a placeholder references a parameter that does not exist
     * @param mixed $value
     */
    public function resolveValue($value);
    /**
     * Escape parameter placeholders %.
     * @param mixed $value
     * @return mixed
     */
    public function escapeValue($value);
    /**
     * Unescape parameter placeholders %.
     * @param mixed $value
     * @return mixed
     */
    public function unescapeValue($value);
}
