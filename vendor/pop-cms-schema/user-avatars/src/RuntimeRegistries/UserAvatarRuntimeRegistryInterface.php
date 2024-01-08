<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserAvatars\RuntimeRegistries;

use PoPCMSSchema\UserAvatars\ObjectModels\UserAvatar;
/** @internal */
interface UserAvatarRuntimeRegistryInterface
{
    public function storeUserAvatar(UserAvatar $userAvatar) : void;
    /**
     * @param string|int $id
     */
    public function getUserAvatar($id) : ?UserAvatar;
}
