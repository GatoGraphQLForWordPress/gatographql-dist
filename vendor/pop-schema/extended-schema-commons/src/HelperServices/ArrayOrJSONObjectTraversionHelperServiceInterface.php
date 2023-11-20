<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\HelperServices;

use PoP\Engine\Exception\RuntimeOperationException;
use stdClass;
/** @internal */
interface ArrayOrJSONObjectTraversionHelperServiceInterface
{
    /**
     * @throws RuntimeOperationException If the path cannot be reached under the array
     * @param array<string|int,mixed>|stdClass $data
     * @param int|string $path
     * @return mixed
     */
    public function &getPointerToArrayItemOrObjectPropertyUnderPath(&$data, $path);
    /**
     * @throws RuntimeOperationException If the path cannot be reached under the array
     * @param array<string|int,mixed>|stdClass $data
     * @param int|string $path
     * @param mixed $value
     */
    public function setValueToArrayItemOrObjectPropertyUnderPath(&$data, $path, $value) : void;
}
