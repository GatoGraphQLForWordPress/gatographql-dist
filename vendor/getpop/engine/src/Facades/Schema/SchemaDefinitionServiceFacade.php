<?php

declare (strict_types=1);
namespace PoP\Engine\Facades\Schema;

use PoP\Root\App;
use PoP\Engine\Schema\SchemaDefinitionServiceInterface;
/** @internal */
class SchemaDefinitionServiceFacade
{
    public static function getInstance() : SchemaDefinitionServiceInterface
    {
        /**
         * @var SchemaDefinitionServiceInterface
         */
        $service = App::getContainer()->get(SchemaDefinitionServiceInterface::class);
        return $service;
    }
}
