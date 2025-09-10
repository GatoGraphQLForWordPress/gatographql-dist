<?php

declare (strict_types=1);
namespace GatoExternalPrefixByGatoGraphQL\League\Pipeline;

/** @internal */
interface StageInterface
{
    /**
     * Process the payload.
     *
     * @param mixed $payload
     *
     * @return mixed
     */
    public function __invoke($payload);
}
