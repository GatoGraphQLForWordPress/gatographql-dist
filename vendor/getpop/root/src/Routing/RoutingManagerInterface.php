<?php

declare (strict_types=1);
namespace PoP\Root\Routing;

/** @internal */
interface RoutingManagerInterface
{
    public function getCurrentRequestNature() : string;
    public function getCurrentRoute() : string;
}
