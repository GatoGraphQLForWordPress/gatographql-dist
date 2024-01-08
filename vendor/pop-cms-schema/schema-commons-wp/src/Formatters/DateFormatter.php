<?php

declare(strict_types=1);

namespace PoPCMSSchema\SchemaCommonsWP\Formatters;

use PoPCMSSchema\SchemaCommons\Formatters\DateFormatterInterface;

use function mysql2date;

class DateFormatter implements DateFormatterInterface
{
    /**
     * @return string|int|false
     */
    public function format(string $format, string $date)
    {
        return mysql2date($format, $date);
    }
}
