<?php

namespace PrefixedByPoP\Psr\Log;

/**
 * Basic Implementation of LoggerAwareInterface.
 * @internal
 */
trait LoggerAwareTrait
{
    /**
     * The logger instance.
     * @var \Psr\Log\LoggerInterface|null
     */
    protected $logger;
    /**
     * Sets a logger.
     */
    public function setLogger(LoggerInterface $logger) : void
    {
        $this->logger = $logger;
    }
}
