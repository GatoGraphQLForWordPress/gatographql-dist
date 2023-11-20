<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserRoles\FilterInputs;

use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;
/** @internal */
class UserRolesFilterInput extends AbstractValueToQueryFilterInput
{
    protected function getQueryArgKey() : string
    {
        return 'user-roles';
    }
}
