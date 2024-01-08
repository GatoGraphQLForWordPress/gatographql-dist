<?php

declare (strict_types=1);
namespace PoP\ComponentModel\QueryResolution;

use stdClass;
/**
 * Factory to retrieve the special object that holds the data for "all objects"
 * for the FieldDataAccessProvider.
 *
 * As it is stored in SplObjectStorage, this object instance must be unique,
 * hence the Singleton pattern.
 * @internal
 */
class FieldDataAccessWildcardObjectFactory
{
    /**
     * @var object|null
     */
    private static $wildcardObject;
    public static function getWildcardObject() : object
    {
        if (self::$wildcardObject === null) {
            self::$wildcardObject = new stdClass();
        }
        return self::$wildcardObject;
    }
}
