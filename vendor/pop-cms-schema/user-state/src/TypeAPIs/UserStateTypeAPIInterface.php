<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserState\TypeAPIs;

/** @internal */
interface UserStateTypeAPIInterface
{
    public function isUserLoggedIn() : bool;
    public function getCurrentUser() : ?object;
    public function getCurrentUserID() : string|int|null;
}
