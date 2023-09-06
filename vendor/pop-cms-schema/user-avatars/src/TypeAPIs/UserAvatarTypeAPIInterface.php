<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserAvatars\TypeAPIs;

interface UserAvatarTypeAPIInterface
{
    /**
     * @param string|int|object $userObjectOrID
     */
    public function getUserAvatarSrc($userObjectOrID, int $size = 150) : ?string;
}
