<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Facades\Variables;

use PoP\Root\App;
use PoP\ComponentModel\Variables\VariableManagerInterface;
/** @internal */
class VariableManagerFacade
{
    public static function getInstance() : VariableManagerInterface
    {
        /**
         * @var VariableManagerInterface
         */
        $service = App::getContainer()->get(VariableManagerInterface::class);
        return $service;
    }
}
