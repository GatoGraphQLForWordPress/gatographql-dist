<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Dictionaries;

/**
 * Store objects in memory, under the class of the object.
 *
 * This class is (among others) used by Transient Objects,
 * which are created on runtime and need to be stored as
 * to be accessed through their ID in the GraphQL query.
 */
class ObjectDictionary implements \PoP\ComponentModel\Dictionaries\ObjectDictionaryInterface
{
    /**
     * @var array<string,array<string|int,mixed>>
     */
    protected $dictionary = [];
    /**
     * @param string|int $id
     * @return mixed
     */
    public function get(string $class, $id)
    {
        return $this->dictionary[$class][$id] ?? null;
    }
    /**
     * @param string|int $id
     */
    public function has(string $class, $id) : bool
    {
        // The stored item can also be null!
        return \array_key_exists($id, $this->dictionary[$class] ?? []);
    }
    /**
     * @param string|int $id
     * @param mixed $instance
     */
    public function set(string $class, $id, $instance) : void
    {
        $this->dictionary[$class][$id] = $instance;
    }
}
