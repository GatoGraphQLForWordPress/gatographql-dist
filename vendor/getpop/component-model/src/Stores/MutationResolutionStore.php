<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Stores;

class MutationResolutionStore implements \PoP\ComponentModel\Stores\MutationResolutionStoreInterface
{
    /**
     * @var array<string,mixed>
     */
    private $results = [];
    /**
     * @param mixed $result
     */
    public function setResult(object $object, $result) : void
    {
        $this->results[\get_class($object)] = $result;
    }
    /**
     * @return mixed
     */
    public function getResult(object $object)
    {
        return $this->results[\get_class($object)];
    }
}
