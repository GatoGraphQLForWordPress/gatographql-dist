<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectSerialization;

use stdClass;
/** @internal */
interface ObjectSerializerInterface
{
    public function getObjectClassToSerialize() : string;
    /**
     * @return string|\stdClass
     */
    public function serialize(object $object);
}
