<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Dictionaries;

interface ObjectDictionaryInterface
{
    /**
     * @param string|int $id
     * @return mixed
     */
    public function get(string $class, $id);
    /**
     * @param string|int $id
     */
    public function has(string $class, $id) : bool;
    /**
     * @param string|int $id
     * @param mixed $instance
     */
    public function set(string $class, $id, $instance) : void;
}
