<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMutations\TypeAPIs;

/** @internal */
interface UserTypeMutationAPIInterface
{
    /**
     * @param string|int $userID
     */
    public function canLoggedInUserEditUser($userID) : bool;
}
