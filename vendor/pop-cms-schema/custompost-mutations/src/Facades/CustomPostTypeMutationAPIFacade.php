<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostMutations\Facades;

use PoP\Root\App;
use PoPCMSSchema\CustomPostMutations\TypeAPIs\CustomPostTypeMutationAPIInterface;
/** @internal */
class CustomPostTypeMutationAPIFacade
{
    public static function getInstance() : CustomPostTypeMutationAPIInterface
    {
        /**
         * @var CustomPostTypeMutationAPIInterface
         */
        $service = App::getContainer()->get(CustomPostTypeMutationAPIInterface::class);
        return $service;
    }
}
