<?php

declare (strict_types=1);
namespace PoPSchema\HTTPRequests\Facades\HelperServices;

use PoPSchema\HTTPRequests\HelperServices\HTTPRequestHelperServiceInterface;
use PoP\Root\App;
/** @internal */
class HTTPRequestHelperServiceFacade
{
    public static function getInstance() : HTTPRequestHelperServiceInterface
    {
        /**
         * @var HTTPRequestHelperServiceInterface
         */
        $service = App::getContainer()->get(HTTPRequestHelperServiceInterface::class);
        return $service;
    }
}
