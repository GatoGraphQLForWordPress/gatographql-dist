<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserState\Checkpoints;

use PoP\ComponentModel\Checkpoints\AbstractAggregateCheckpoint;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\Engine\Checkpoints\DoingPostCheckpoint;
use PoPCMSSchema\UserState\Checkpoints\UserNotLoggedInCheckpoint;
/** @internal */
class DoingPostUserNotLoggedInAggregateCheckpoint extends AbstractAggregateCheckpoint
{
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserNotLoggedInCheckpoint|null
     */
    private $userNotLoggedInCheckpoint;
    /**
     * @var \PoP\Engine\Checkpoints\DoingPostCheckpoint|null
     */
    private $doingPostCheckpoint;
    public final function setUserNotLoggedInCheckpoint(UserNotLoggedInCheckpoint $userNotLoggedInCheckpoint) : void
    {
        $this->userNotLoggedInCheckpoint = $userNotLoggedInCheckpoint;
    }
    protected final function getUserNotLoggedInCheckpoint() : UserNotLoggedInCheckpoint
    {
        if ($this->userNotLoggedInCheckpoint === null) {
            /** @var UserNotLoggedInCheckpoint */
            $userNotLoggedInCheckpoint = $this->instanceManager->getInstance(UserNotLoggedInCheckpoint::class);
            $this->userNotLoggedInCheckpoint = $userNotLoggedInCheckpoint;
        }
        return $this->userNotLoggedInCheckpoint;
    }
    public final function setDoingPostCheckpoint(DoingPostCheckpoint $doingPostCheckpoint) : void
    {
        $this->doingPostCheckpoint = $doingPostCheckpoint;
    }
    protected final function getDoingPostCheckpoint() : DoingPostCheckpoint
    {
        if ($this->doingPostCheckpoint === null) {
            /** @var DoingPostCheckpoint */
            $doingPostCheckpoint = $this->instanceManager->getInstance(DoingPostCheckpoint::class);
            $this->doingPostCheckpoint = $doingPostCheckpoint;
        }
        return $this->doingPostCheckpoint;
    }
    /**
     * @return CheckpointInterface[]
     */
    protected function getCheckpoints() : array
    {
        return [$this->getDoingPostCheckpoint(), $this->getUserNotLoggedInCheckpoint()];
    }
}
