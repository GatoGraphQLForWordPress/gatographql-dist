<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectSerialization;

use stdClass;
interface ObjectSerializerInterface
{
    public function getObjectClassToSerialize() : string;
    /**
     * @return string|\stdClass
     */
    public function serialize(object $object);
}
