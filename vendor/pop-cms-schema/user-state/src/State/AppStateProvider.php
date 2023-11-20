<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserState\State;

use PoP\Root\State\AbstractAppStateProvider;
use PoPCMSSchema\UserState\TypeAPIs\UserStateTypeAPIInterface;
/** @internal */
class AppStateProvider extends AbstractAppStateProvider
{
    /**
     * @var \PoPCMSSchema\UserState\TypeAPIs\UserStateTypeAPIInterface|null
     */
    private $userStateTypeAPI;
    public final function setUserStateTypeAPI(UserStateTypeAPIInterface $userStateTypeAPI) : void
    {
        $this->userStateTypeAPI = $userStateTypeAPI;
    }
    protected final function getUserStateTypeAPI() : UserStateTypeAPIInterface
    {
        if ($this->userStateTypeAPI === null) {
            /** @var UserStateTypeAPIInterface */
            $userStateTypeAPI = $this->instanceManager->getInstance(UserStateTypeAPIInterface::class);
            $this->userStateTypeAPI = $userStateTypeAPI;
        }
        return $this->userStateTypeAPI;
    }
    /**
     * @param array<string,mixed> $state
     */
    public function initialize(array &$state) : void
    {
        $this->setUserStateVars($state);
    }
    /**
     * Add the user's (non)logged-in state
     *
     * @param array<string,mixed> $state
     */
    public function setUserStateVars(array &$state) : void
    {
        if ($this->getUserStateTypeAPI()->isUserLoggedIn()) {
            $state['is-user-logged-in'] = \true;
            $state['current-user'] = $this->getUserStateTypeAPI()->getCurrentUser();
            $state['current-user-id'] = $this->getUserStateTypeAPI()->getCurrentUserID();
            return;
        }
        $state['is-user-logged-in'] = \false;
        $state['current-user'] = null;
        $state['current-user-id'] = null;
    }
}
