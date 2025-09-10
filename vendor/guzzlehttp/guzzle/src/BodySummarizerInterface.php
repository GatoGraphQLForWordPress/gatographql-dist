<?php

namespace GatoExternalPrefixByGatoGraphQL\GuzzleHttp;

use GatoExternalPrefixByGatoGraphQL\Psr\Http\Message\MessageInterface;
/** @internal */
interface BodySummarizerInterface
{
    /**
     * Returns a summarized message body.
     */
    public function summarize(MessageInterface $message) : ?string;
}
