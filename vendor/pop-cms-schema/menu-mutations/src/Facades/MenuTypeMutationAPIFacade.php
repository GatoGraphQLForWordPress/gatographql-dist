<?php

declare (strict_types=1);
namespace PoPCMSSchema\MenuMutations\Facades;

use PoP\Root\App;
use PoPCMSSchema\MenuMutations\TypeAPIs\MenuTypeMutationAPIInterface;
/** @internal */
class MenuTypeMutationAPIFacade
{
    public static function getInstance() : MenuTypeMutationAPIInterface
    {
        /**
         * @var MenuTypeMutationAPIInterface
         */
        $service = App::getContainer()->get(MenuTypeMutationAPIInterface::class);
        return $service;
    }
}
