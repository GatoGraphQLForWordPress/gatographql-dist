<?php

declare (strict_types=1);
namespace PoP\Root\Instances;

use PoP\Root\App;
/** @internal */
class InstanceManager implements \PoP\Root\Instances\InstanceManagerInterface
{
    public function getInstance(string $class) : object
    {
        $containerBuilder = App::getContainer();
        /** @var object */
        return $containerBuilder->get($class);
    }
    public function hasInstance(string $class) : bool
    {
        $containerBuilder = App::getContainer();
        return $containerBuilder->has($class);
    }
}
