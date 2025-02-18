<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\ObjectSerializers;

use DateTime;
use DateTimeInterface;
use PoP\ComponentModel\ObjectSerialization\AbstractObjectSerializer;
use stdClass;
/** @internal */
class DateTimeObjectSerializer extends AbstractObjectSerializer
{
    public function getObjectClassToSerialize() : string
    {
        return DateTime::class;
    }
    /**
     * @return string|\stdClass
     */
    public function serialize(object $object)
    {
        /** @var DateTime $object */
        return $object->format(DateTimeInterface::ATOM);
    }
}
