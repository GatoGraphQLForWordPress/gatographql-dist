<?php

namespace PrefixedByPoP\Psr\Log;

/**
 * Describes a logger-aware instance.
 * @internal
 */
interface LoggerAwareInterface
{
    /**
     * Sets a logger instance on the object.
     */
    public function setLogger(LoggerInterface $logger) : void;
}
