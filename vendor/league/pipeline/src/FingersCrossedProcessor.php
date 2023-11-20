<?php

declare (strict_types=1);
namespace PrefixedByPoP\League\Pipeline;

/** @internal */
class FingersCrossedProcessor implements ProcessorInterface
{
    public function process($payload, callable ...$stages)
    {
        foreach ($stages as $stage) {
            $payload = $stage($payload);
        }
        return $payload;
    }
}
