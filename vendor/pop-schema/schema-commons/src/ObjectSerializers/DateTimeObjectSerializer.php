<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\ObjectSerializers;

use DateTime;
// @todo Replace with \DateTimeInterface. See: https://github.com/GatoGraphQL/GatoGraphQL/issues/1282
use PoPSchema\SchemaCommons\Polyfill\PHP72\DateTimeInterface;
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
