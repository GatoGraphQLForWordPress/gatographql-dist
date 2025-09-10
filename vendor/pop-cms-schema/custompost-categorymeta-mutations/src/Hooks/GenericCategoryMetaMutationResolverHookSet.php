<?php

declare (strict_types=1);
namespace PoPCMSSchema\CustomPostCategoryMetaMutations\Hooks;

use PoPCMSSchema\CategoryMetaMutations\Hooks\AbstractCategoryMetaMutationResolverHookSet;
use PoPCMSSchema\CustomPostCategoryMutations\Constants\GenericCategoryCRUDHookNames;
/** @internal */
class GenericCategoryMetaMutationResolverHookSet extends AbstractCategoryMetaMutationResolverHookSet
{
    protected function getValidateCreateHookName() : string
    {
        return GenericCategoryCRUDHookNames::VALIDATE_CREATE;
    }
    protected function getValidateUpdateHookName() : ?string
    {
        return GenericCategoryCRUDHookNames::VALIDATE_UPDATE;
    }
    protected function getExecuteCreateOrUpdateHookName() : string
    {
        return GenericCategoryCRUDHookNames::EXECUTE_CREATE_OR_UPDATE;
    }
}
