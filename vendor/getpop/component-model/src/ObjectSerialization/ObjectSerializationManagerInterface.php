<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectSerialization;

use stdClass;
/** @internal */
interface ObjectSerializationManagerInterface
{
    public function addObjectSerializer(\PoP\ComponentModel\ObjectSerialization\ObjectSerializerInterface $objectSerializer) : void;
    public function serialize(object $object) : string|stdClass;
}
