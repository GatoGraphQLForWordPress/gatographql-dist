<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Stores;

/** @internal */
interface MutationResolutionStoreInterface
{
    /**
     * @param mixed $result
     */
    public function setResult(object $object, $result) : void;
    /**
     * @return mixed
     */
    public function getResult(object $object);
}
