<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectTypeResolverPickers;

use PoP\ComponentModel\Dictionaries\ObjectDictionaryInterface;
/** @internal */
abstract class AbstractTransientObjectObjectTypeResolverPicker extends \PoP\ComponentModel\ObjectTypeResolverPickers\AbstractObjectTypeResolverPicker
{
    /**
     * @var \PoP\ComponentModel\Dictionaries\ObjectDictionaryInterface|null
     */
    private $objectDictionary;
    protected final function getObjectDictionary() : ObjectDictionaryInterface
    {
        if ($this->objectDictionary === null) {
            /** @var ObjectDictionaryInterface */
            $objectDictionary = $this->instanceManager->getInstance(ObjectDictionaryInterface::class);
            $this->objectDictionary = $objectDictionary;
        }
        return $this->objectDictionary;
    }
    public final function isInstanceOfType(object $object) : bool
    {
        return \is_a($object, $this->getTargetObjectClass(), \true);
    }
    protected abstract function getTargetObjectClass() : string;
    /**
     * @param string|int $objectID
     */
    public final function isIDOfType($objectID) : bool
    {
        $transientObject = $this->getObjectDictionary()->get($this->getTargetObjectClass(), $objectID);
        if ($transientObject === null) {
            return \false;
        }
        return $this->isInstanceOfType($transientObject);
    }
}
