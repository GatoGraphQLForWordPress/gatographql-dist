<?php

declare (strict_types=1);
namespace PoP\ComponentModel\DataStructure;

use PoP\ComponentModel\DataStructureFormatters\DataStructureFormatterInterface;
use PoP\Root\App;
class DataStructureManager implements \PoP\ComponentModel\DataStructure\DataStructureManagerInterface
{
    /**
     * @var \PoP\ComponentModel\DataStructureFormatters\DataStructureFormatterInterface
     */
    protected $defaultFormatter;
    /**
     * @var array<string,DataStructureFormatterInterface>
     */
    public $formatters = [];
    public function __construct(DataStructureFormatterInterface $defaultFormatter)
    {
        $this->defaultFormatter = $defaultFormatter;
    }
    public function addDataStructureFormatter(DataStructureFormatterInterface $formatter) : void
    {
        $this->formatters[$formatter->getName()] = $formatter;
    }
    public function setDefaultDataStructureFormatter(DataStructureFormatterInterface $defaultFormatter) : void
    {
        $this->defaultFormatter = $defaultFormatter;
    }
    public function getDataStructureFormatter(string $name = null) : DataStructureFormatterInterface
    {
        // Return the formatter if it exists
        if ($name && isset($this->formatters[$name])) {
            return $this->formatters[$name];
        }
        // Return the one saved in the vars
        $name = App::getState('datastructure');
        if ($name !== null && isset($this->formatters[$name])) {
            return $this->formatters[$name];
        }
        return $this->defaultFormatter;
    }
}
