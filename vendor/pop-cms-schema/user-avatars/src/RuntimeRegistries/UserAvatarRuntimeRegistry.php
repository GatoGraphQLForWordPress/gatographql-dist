<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserAvatars\RuntimeRegistries;

use PoPCMSSchema\UserAvatars\ObjectModels\UserAvatar;
class UserAvatarRuntimeRegistry implements \PoPCMSSchema\UserAvatars\RuntimeRegistries\UserAvatarRuntimeRegistryInterface
{
    /** @var array<string|int,UserAvatar> */
    protected $userAvatars = [];
    public function storeUserAvatar(UserAvatar $userAvatar) : void
    {
        $this->userAvatars[$userAvatar->id] = $userAvatar;
    }
    /**
     * @param string|int $id
     */
    public function getUserAvatar($id) : ?UserAvatar
    {
        return $this->userAvatars[$id] ?? null;
    }
}
