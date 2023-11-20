<?php

declare (strict_types=1);
namespace PoP\Root\Facades\Instances;

use PoP\Root\App;
use PoP\Root\Instances\InstanceManagerInterface;
/** @internal */
class InstanceManagerFacade
{
    public static function getInstance() : InstanceManagerInterface
    {
        /**
         * @var InstanceManagerInterface
         */
        $service = App::getContainer()->get(InstanceManagerInterface::class);
        return $service;
    }
}
