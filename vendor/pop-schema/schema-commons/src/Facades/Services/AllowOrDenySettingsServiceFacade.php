<?php

declare (strict_types=1);
namespace PoPSchema\SchemaCommons\Facades\Services;

use PoP\Root\App;
use PoPSchema\SchemaCommons\Services\AllowOrDenySettingsServiceInterface;
/** @internal */
class AllowOrDenySettingsServiceFacade
{
    public static function getInstance() : AllowOrDenySettingsServiceInterface
    {
        /**
         * @var AllowOrDenySettingsServiceInterface
         */
        $service = App::getContainer()->get(AllowOrDenySettingsServiceInterface::class);
        return $service;
    }
}
