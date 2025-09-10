<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Facades\Registries;

use PoP\Root\App;
use PoP\ComponentModel\Registries\TypeRegistryInterface;
/** @internal */
class TypeRegistryFacade
{
    public static function getInstance() : TypeRegistryInterface
    {
        /**
         * @var TypeRegistryInterface
         */
        $service = App::getContainer()->get(TypeRegistryInterface::class);
        return $service;
    }
}
