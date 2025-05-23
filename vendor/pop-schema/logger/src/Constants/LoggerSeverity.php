<?php

declare (strict_types=1);
namespace PoPSchema\Logger\Constants;

/** @internal */
class LoggerSeverity
{
    public const ERROR = 'ERROR';
    public const WARNING = 'WARNING';
    public const INFO = 'INFO';
    public const DEBUG = 'DEBUG';
    /**
     * @return string[]
     */
    public const ALL = [self::ERROR, self::WARNING, self::INFO, self::DEBUG];
}
