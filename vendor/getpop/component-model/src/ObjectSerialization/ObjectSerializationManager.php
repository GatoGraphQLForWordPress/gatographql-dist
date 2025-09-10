<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectSerialization;

use PoP\Root\Exception\ShouldNotHappenException;
use PoP\Root\Services\AbstractBasicService;
use stdClass;
/** @internal */
class ObjectSerializationManager extends AbstractBasicService implements \PoP\ComponentModel\ObjectSerialization\ObjectSerializationManagerInterface
{
    /**
     * @var array<string,ObjectSerializerInterface>
     */
    public array $objectSerializers = [];
    public final function addObjectSerializer(\PoP\ComponentModel\ObjectSerialization\ObjectSerializerInterface $objectSerializer) : void
    {
        $this->objectSerializers[$objectSerializer->getObjectClassToSerialize()] = $objectSerializer;
    }
    public function serialize(object $object) : string|stdClass
    {
        // Find the Serialize that serializes this object
        $objectSerializer = null;
        $classToSerialize = $object::class;
        while ($objectSerializer === null && $classToSerialize !== \false) {
            $objectSerializer = $this->objectSerializers[$classToSerialize] ?? null;
            $classToSerialize = \get_parent_class($classToSerialize);
        }
        if ($objectSerializer !== null) {
            return $objectSerializer->serialize($object);
        }
        /**
         * No Serializer found. Then call the '__serialize' method of the object,
         * expecting it to implement it. If it doesn't, it will throw an exception,
         * so the developer will be made aware to create the corresponding Serializer
         * for that object class
         */
        if (!\method_exists($object, '__serialize')) {
            throw new ShouldNotHappenException(\sprintf($this->__('The object of class \'%s\' does not support method \'__serialize\'', 'component-model'), \get_class($object)));
        }
        $serialized = $object->__serialize();
        if (\is_array($serialized)) {
            return (object) $serialized;
        }
        return $serialized;
    }
}
