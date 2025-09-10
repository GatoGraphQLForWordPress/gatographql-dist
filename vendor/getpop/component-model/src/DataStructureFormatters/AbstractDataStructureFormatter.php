<?php

declare (strict_types=1);
namespace PoP\ComponentModel\DataStructureFormatters;

use PoP\Root\Services\AbstractBasicService;
/** @internal */
abstract class AbstractDataStructureFormatter extends AbstractBasicService implements \PoP\ComponentModel\DataStructureFormatters\DataStructureFormatterInterface
{
    /**
     * @return array<string,mixed>
     * @param array<string,mixed> $data
     */
    public function getFormattedData(array $data) : array
    {
        return $data;
    }
}
