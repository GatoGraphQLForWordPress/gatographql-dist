<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMedia\Facades;

use PoP\Root\App;
use PoPCMSSchema\CustomPostMedia\TypeAPIs\CustomPostMediaTypeAPIInterface;
/** @internal */
class CustomPostMediaTypeAPIFacade
{
    public static function getInstance() : CustomPostMediaTypeAPIInterface
    {
        /**
         * @var CustomPostMediaTypeAPIInterface
         */
        $service = App::getContainer()->get(CustomPostMediaTypeAPIInterface::class);
        return $service;
    }
}
