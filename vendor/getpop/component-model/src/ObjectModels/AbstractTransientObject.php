<?php

declare (strict_types=1);
namespace PoP\ComponentModel\ObjectModels;

use PoP\ComponentModel\Dictionaries\ObjectDictionaryInterface;
use PoP\Root\Facades\Instances\InstanceManagerFacade;
use PoP\Root\Services\StandaloneServiceTrait;
/**
 * A Transient Object is automatically added to the Object Dictionary
 * under the class of the object.
 * @internal
 */
abstract class AbstractTransientObject implements \PoP\ComponentModel\ObjectModels\TransientObjectInterface
{
    use StandaloneServiceTrait;
    /**
     * @var \PoP\ComponentModel\Dictionaries\ObjectDictionaryInterface|null
     */
    private $objectDictionary;
    protected final function getObjectDictionary() : ObjectDictionaryInterface
    {
        if ($this->objectDictionary === null) {
            /** @var ObjectDictionaryInterface */
            $objectDictionary = InstanceManagerFacade::getInstance()->getInstance(ObjectDictionaryInterface::class);
            $this->objectDictionary = $objectDictionary;
        }
        return $this->objectDictionary;
    }
    /**
     * Static ID generator: all Transient Objects, from whatever class,
     * will have different IDs.
     * @var int
     */
    public static $counter = 0;
    /**
     * @readonly
     * @var string|int
     */
    public $id;
    /**
     * Allow to specify the ID of the object or,
     * if not provided, it will be automatically
     * generated using a counter.
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        if ($id === null) {
            self::$counter++;
        }
        $this->id = $id !== null ? $id : self::$counter;
        // Register the object in the registry
        $this->getObjectDictionary()->set(\get_called_class(), $this->getID(), $this);
    }
    /**
     * @return int|string
     */
    public function getID()
    {
        return $this->id;
    }
}
