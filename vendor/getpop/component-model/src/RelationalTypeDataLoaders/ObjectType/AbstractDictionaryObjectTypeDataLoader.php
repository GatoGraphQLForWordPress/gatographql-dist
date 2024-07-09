<?php

declare (strict_types=1);
namespace PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType;

use PoP\ComponentModel\Dictionaries\ObjectDictionaryInterface;
/** @internal */
abstract class AbstractDictionaryObjectTypeDataLoader extends \PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\AbstractObjectTypeDataLoader implements \PoP\ComponentModel\RelationalTypeDataLoaders\ObjectType\DictionaryObjectTypeDataLoaderInterface
{
    /**
     * @var \PoP\ComponentModel\Dictionaries\ObjectDictionaryInterface|null
     */
    private $objectDictionary;
    public final function setObjectDictionary(ObjectDictionaryInterface $objectDictionary) : void
    {
        $this->objectDictionary = $objectDictionary;
    }
    protected final function getObjectDictionary() : ObjectDictionaryInterface
    {
        if ($this->objectDictionary === null) {
            /** @var ObjectDictionaryInterface */
            $objectDictionary = $this->instanceManager->getInstance(ObjectDictionaryInterface::class);
            $this->objectDictionary = $objectDictionary;
        }
        return $this->objectDictionary;
    }
    /**
     * @param array<string|int> $ids
     * @return array<object|null>
     */
    public function getObjects(array $ids) : array
    {
        $objectClass = $this->getObjectClass();
        $objectDictionary = $this->getObjectDictionary();
        return \array_map(function ($id) use($objectDictionary, $objectClass) {
            return $objectDictionary->get($objectClass, $id);
        }, $ids);
    }
}
