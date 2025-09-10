<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserAvatars\TypeAPIs;

/** @internal */
interface UserAvatarTypeAPIInterface
{
    public function getUserAvatarSrc(string|int|object $userObjectOrID, int $size = 150) : ?string;
}
