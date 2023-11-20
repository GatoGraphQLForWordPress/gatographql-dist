<?php

declare (strict_types=1);
namespace PoP\ComponentModel\DataStructureFormatters;

use PoP\Root\Services\BasicServiceTrait;
/** @internal */
abstract class AbstractDataStructureFormatter implements \PoP\ComponentModel\DataStructureFormatters\DataStructureFormatterInterface
{
    use BasicServiceTrait;
    /**
     * @return array<string,mixed>
     * @param array<string,mixed> $data
     */
    public function getFormattedData(array $data) : array
    {
        return $data;
    }
}
