<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Response;

use PoP\Root\Services\AbstractBasicService;
use stdClass;
/** @internal */
class OutputService extends AbstractBasicService implements \PoP\ComponentModel\Response\OutputServiceInterface
{
    /**
     * Encode the array, and trim to 500 chars max
     *
     * @param mixed[]|stdClass $value
     */
    public function jsonEncodeArrayOrStdClassValue($value) : string
    {
        return \mb_strimwidth((string) \json_encode($value), 0, 500, $this->__('...', 'graphql-parser'));
    }
}
