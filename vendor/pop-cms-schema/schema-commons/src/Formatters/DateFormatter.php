<?php

declare (strict_types=1);
namespace PoPCMSSchema\SchemaCommons\Formatters;

/** @internal */
class DateFormatter implements \PoPCMSSchema\SchemaCommons\Formatters\DateFormatterInterface
{
    /**
     * @return string|int|false
     */
    public function format(string $format, string $date)
    {
        $time = \strtotime($date);
        if ($time === \false) {
            return \false;
        }
        return \date($format, $time);
    }
}
