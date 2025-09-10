<?php

declare (strict_types=1);
namespace PoPSchema\Logger\Log;

/** @internal */
interface LoggerInterface
{
    /**
     * @param array<string,mixed>|null $context
     */
    public function log(string $severity, string $message, string $loggerSource = \PoPSchema\Logger\Log\LoggerSources::INFO, ?array $context = null) : void;
}
