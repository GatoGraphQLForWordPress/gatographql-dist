<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Facades\Registries;

use PoP\Root\App;
use PoP\ComponentModel\Registries\MetaDirectiveRegistryInterface;
/** @internal */
class MetaDirectiveRegistryFacade
{
    public static function getInstance() : MetaDirectiveRegistryInterface
    {
        /**
         * @var MetaDirectiveRegistryInterface
         */
        $service = App::getContainer()->get(MetaDirectiveRegistryInterface::class);
        return $service;
    }
}
