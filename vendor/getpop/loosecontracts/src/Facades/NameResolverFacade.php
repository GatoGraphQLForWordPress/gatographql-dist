<?php

declare (strict_types=1);
namespace PoP\LooseContracts\Facades;

use PoP\Root\App;
use PoP\LooseContracts\NameResolverInterface;
/** @internal */
class NameResolverFacade
{
    public static function getInstance() : NameResolverInterface
    {
        /**
         * @var NameResolverInterface
         */
        $service = App::getContainer()->get(NameResolverInterface::class);
        return $service;
    }
}
