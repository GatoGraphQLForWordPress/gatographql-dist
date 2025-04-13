<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserMetaMutations\Hooks;

use PoPCMSSchema\UserMetaMutations\MutationResolvers\MutateUserMetaMutationResolverTrait;
use PoPCMSSchema\UserMetaMutations\TypeAPIs\UserMetaTypeMutationAPIInterface;
use PoPCMSSchema\UserMeta\TypeAPIs\UserMetaTypeAPIInterface;
use PoPCMSSchema\MetaMutations\Hooks\AbstractMetaMutationResolverHookSet;
use PoPCMSSchema\MetaMutations\TypeAPIs\EntityMetaTypeMutationAPIInterface;
use PoPCMSSchema\Meta\TypeAPIs\MetaTypeAPIInterface;
/** @internal */
abstract class AbstractUserMetaMutationResolverHookSet extends AbstractMetaMutationResolverHookSet
{
    use MutateUserMetaMutationResolverTrait;
    /**
     * @var \PoPCMSSchema\UserMetaMutations\TypeAPIs\UserMetaTypeMutationAPIInterface|null
     */
    private $userMetaTypeMutationAPI;
    /**
     * @var \PoPCMSSchema\UserMeta\TypeAPIs\UserMetaTypeAPIInterface|null
     */
    private $userMetaTypeAPI;
    protected final function getUserMetaTypeMutationAPI() : UserMetaTypeMutationAPIInterface
    {
        if ($this->userMetaTypeMutationAPI === null) {
            /** @var UserMetaTypeMutationAPIInterface */
            $userMetaTypeMutationAPI = $this->instanceManager->getInstance(UserMetaTypeMutationAPIInterface::class);
            $this->userMetaTypeMutationAPI = $userMetaTypeMutationAPI;
        }
        return $this->userMetaTypeMutationAPI;
    }
    protected final function getUserMetaTypeAPI() : UserMetaTypeAPIInterface
    {
        if ($this->userMetaTypeAPI === null) {
            /** @var UserMetaTypeAPIInterface */
            $userMetaTypeAPI = $this->instanceManager->getInstance(UserMetaTypeAPIInterface::class);
            $this->userMetaTypeAPI = $userMetaTypeAPI;
        }
        return $this->userMetaTypeAPI;
    }
    protected function getEntityMetaTypeMutationAPI() : EntityMetaTypeMutationAPIInterface
    {
        return $this->getUserMetaTypeMutationAPI();
    }
    protected function getMetaTypeAPI() : MetaTypeAPIInterface
    {
        return $this->getUserMetaTypeAPI();
    }
    // @todo Re-enable when adding User Mutations
    // protected function getErrorPayloadHookName(): string
    // {
    //     return UserCRUDHookNames::ERROR_PAYLOAD;
    // }
}
