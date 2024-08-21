<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserRoles\TypeAPIs;

use PoP\Root\Services\BasicServiceTrait;
/** @internal */
abstract class AbstractUserRoleTypeAPI implements \PoPCMSSchema\UserRoles\TypeAPIs\UserRoleTypeAPIInterface
{
    use BasicServiceTrait;
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getTheUserRole($userObjectOrID) : ?string
    {
        $roles = $this->getUserRoles($userObjectOrID);
        $role = $roles[0] ?? null;
        // Allow URE to override this function
        // @todo convert the hook from string to const, then re-enable
        // return App::applyFilters(
        //     'getTheUserRole',
        //     $role,
        //     $userObjectOrID
        // );
        return $role;
    }
    /**
     * @param string|int|object $userObjectOrID
     * @param mixed ...$args
     */
    public function userCan($userObjectOrID, string $capability, ...$args) : bool
    {
        $capabilities = $this->getUserCapabilities($userObjectOrID);
        return \in_array($capability, $capabilities);
    }
    /**
     * @param string|int|object $userObjectOrID
     */
    public function hasRole($userObjectOrID, string $role) : bool
    {
        $roles = $this->getUserRoles($userObjectOrID);
        return \in_array($role, $roles);
    }
}
