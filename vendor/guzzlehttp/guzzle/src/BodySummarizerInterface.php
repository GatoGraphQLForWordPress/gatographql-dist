<?php

namespace PrefixedByPoP\GuzzleHttp;

use PrefixedByPoP\Psr\Http\Message\MessageInterface;
interface BodySummarizerInterface
{
    /**
     * Returns a summarized message body.
     */
    public function summarize(MessageInterface $message) : ?string;
}
