<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectSerialization;

use stdClass;
/** @internal */
interface ObjectSerializerInterface
{
    public function getObjectClassToSerialize() : string;
    public function serialize(object $object) : string|stdClass;
}
