<?php

declare (strict_types=1);
namespace PoPSchema\ExtendedSchemaCommons\HelperServices;

use PoP\Engine\Exception\RuntimeOperationException;
use PoP\ComponentModel\Response\OutputServiceInterface;
use PoP\Root\Services\AbstractBasicService;
use PoPSchema\ExtendedSchemaCommons\Constants\OperationSymbols;
use stdClass;
/** @internal */
class ArrayOrJSONObjectTraversionHelperService extends AbstractBasicService implements \PoPSchema\ExtendedSchemaCommons\HelperServices\ArrayOrJSONObjectTraversionHelperServiceInterface
{
    /**
     * @var \PoP\ComponentModel\Response\OutputServiceInterface|null
     */
    private $outputService;
    protected final function getOutputService() : OutputServiceInterface
    {
        if ($this->outputService === null) {
            /** @var OutputServiceInterface */
            $outputService = $this->instanceManager->getInstance(OutputServiceInterface::class);
            $this->outputService = $outputService;
        }
        return $this->outputService;
    }
    /**
     * @throws RuntimeOperationException If the path cannot be reached under the array
     * @param array<string|int,mixed>|stdClass $data
     * @param int|string $path
     * @return mixed
     */
    public function &getPointerToArrayItemOrObjectPropertyUnderPath(&$data, $path)
    {
        $dataPointer =& $data;
        if (\is_integer($path)) {
            if (\is_array($dataPointer) && \array_key_exists($path, $dataPointer)) {
                $dataPointer =& $dataPointer[$path];
            } elseif ($dataPointer instanceof stdClass && \property_exists($dataPointer, (string) $path)) {
                $dataPointer =& $dataPointer->{$path};
            } else {
                $this->throwNoArrayItemUnderPathException($data, $path);
            }
        } else {
            // Iterate the data array to the provided path.
            foreach (\explode(OperationSymbols::ARRAY_PATH_DELIMITER, $path) as $pathLevel) {
                if (!$dataPointer) {
                    // If we reached the end of the array and can't keep going down any level more, then it's an error
                    $this->throwNoArrayItemUnderPathException($data, $path);
                }
                if (\is_array($dataPointer) && \array_key_exists($pathLevel, $dataPointer)) {
                    // Retrieve the property under the pathLevel
                    $dataPointer =& $dataPointer[$pathLevel];
                    continue;
                }
                if ($dataPointer instanceof stdClass && \property_exists($dataPointer, $pathLevel)) {
                    // Retrieve the property under the pathLevel
                    $dataPointer =& $dataPointer->{$pathLevel};
                    continue;
                }
                // We are accessing a level that doesn't exist
                // If we reached the end of the array and can't keep going down any level more, then it's an error
                $this->throwNoArrayItemUnderPathException($data, $path);
            }
        }
        return $dataPointer;
    }
    /**
     * @throws RuntimeOperationException
     * @param array<string|int,mixed>|stdClass $data
     * @param int|string $path
     */
    protected function throwNoArrayItemUnderPathException($data, $path) : void
    {
        throw new RuntimeOperationException(\is_integer($path) ? \sprintf($this->__('Index \'%s\' is not set for array: %s', 'extended-schema-commons'), $path, $this->getOutputService()->jsonEncodeArrayOrStdClassValue($data)) : \sprintf($this->__('Key or path \'%s\' is not reachable for object: %s', 'extended-schema-commons'), $path, $this->getOutputService()->jsonEncodeArrayOrStdClassValue($data)));
    }
    /**
     * @throws RuntimeOperationException
     * @param int|string $path
     * @param mixed $dataPointer
     */
    protected function throwItemUnderPathIsNotArrayException($dataPointer, $path) : void
    {
        throw new RuntimeOperationException(\is_integer($path) ? \sprintf($this->__('The item under index \'%s\' (with value \'%s\') is not an array', 'extended-schema-commons'), $path, $dataPointer) : \sprintf($this->__('The item under path \'%s\' (with value \'%s\') is not an array', 'extended-schema-commons'), $path, $dataPointer));
    }
    /**
     * @throws RuntimeOperationException If the path cannot be reached under the array
     * @param array<string|int,mixed>|stdClass $data
     * @param int|string $path
     * @param mixed $value
     */
    public function setValueToArrayItemOrObjectPropertyUnderPath(&$data, $path, $value) : void
    {
        $dataPointer =& $data;
        if (\is_integer($path)) {
            if (\is_array($dataPointer) && \array_key_exists($path, $dataPointer)) {
                $dataPointer =& $dataPointer[$path];
            } elseif ($dataPointer instanceof stdClass && \property_exists($dataPointer, (string) $path)) {
                $dataPointer =& $dataPointer->{$path};
            } else {
                $this->throwNoArrayItemUnderPathException($data, $path);
            }
        } else {
            // Iterate the data array to the provided path.
            foreach (\explode(OperationSymbols::ARRAY_PATH_DELIMITER, $path) as $pathLevel) {
                if (\is_array($dataPointer) && \array_key_exists($pathLevel, $dataPointer)) {
                    // Retrieve the property under the pathLevel
                    $dataPointer =& $dataPointer[$pathLevel];
                    continue;
                }
                if ($dataPointer instanceof stdClass && \property_exists($dataPointer, $pathLevel)) {
                    // Retrieve the property under the pathLevel
                    $dataPointer =& $dataPointer->{$pathLevel};
                    continue;
                }
                // If we reached the end of the array and can't keep going down any level more, then it's an error
                $this->throwNoArrayItemUnderPathException($data, $path);
            }
        }
        // We reached the end. Set the value
        $dataPointer = $value;
    }
}
