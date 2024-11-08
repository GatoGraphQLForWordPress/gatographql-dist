<?php

declare (strict_types=1);
namespace GatoExternalPrefixByGatoGraphQL\League\Pipeline;

/** @internal */
interface ProcessorInterface
{
    /**
     * Process the payload using multiple stages.
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    public function process($payload, callable ...$stages);
}
