<?php

declare (strict_types=1);
namespace PoP\ComponentModel\Facades\Schema;

use PoP\Root\App;
use PoP\ComponentModel\Schema\SchemaNamespacingServiceInterface;
/** @internal */
class SchemaNamespacingServiceFacade
{
    public static function getInstance() : SchemaNamespacingServiceInterface
    {
        /**
         * @var SchemaNamespacingServiceInterface
         */
        $service = App::getContainer()->get(SchemaNamespacingServiceInterface::class);
        return $service;
    }
}
