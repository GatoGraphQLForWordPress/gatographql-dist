<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectSerialization;

use stdClass;
interface ObjectSerializationManagerInterface
{
    public function addObjectSerializer(\PoP\ComponentModel\ObjectSerialization\ObjectSerializerInterface $objectSerializer) : void;
    /**
     * @return string|\stdClass
     */
    public function serialize(object $object);
}
