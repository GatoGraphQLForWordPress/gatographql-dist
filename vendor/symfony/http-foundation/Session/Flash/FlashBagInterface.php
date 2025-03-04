<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Session\Flash;

use GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Session\SessionBagInterface;
/**
 * FlashBagInterface.
 *
 * @author Drak <drak@zikula.org>
 * @internal
 */
interface FlashBagInterface extends SessionBagInterface
{
    /**
     * Adds a flash message for the given type.
     *
     * @return void
     * @param mixed $message
     */
    public function add(string $type, $message);
    /**
     * Registers one or more messages for a given type.
     *
     * @return void
     * @param string|mixed[] $messages
     */
    public function set(string $type, $messages);
    /**
     * Gets flash messages for a given type.
     *
     * @param string $type    Message category type
     * @param array  $default Default value if $type does not exist
     */
    public function peek(string $type, array $default = []) : array;
    /**
     * Gets all flash messages.
     */
    public function peekAll() : array;
    /**
     * Gets and clears flash from the stack.
     *
     * @param array $default Default value if $type does not exist
     */
    public function get(string $type, array $default = []) : array;
    /**
     * Gets and clears flashes from the stack.
     */
    public function all() : array;
    /**
     * Sets all flash messages.
     *
     * @return void
     */
    public function setAll(array $messages);
    /**
     * Has flash messages for a given type?
     */
    public function has(string $type) : bool;
    /**
     * Returns a list of all defined types.
     */
    public function keys() : array;
}
