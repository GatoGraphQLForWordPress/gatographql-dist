<?php

declare (strict_types=1);
namespace PoPCMSSchema\UserState\Checkpoints;

use PoP\ComponentModel\Checkpoints\AbstractAggregateCheckpoint;
use PoP\ComponentModel\Checkpoints\CheckpointInterface;
use PoP\Engine\Checkpoints\DoingPostCheckpoint;
use PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint;
class DoingPostUserLoggedInAggregateCheckpoint extends AbstractAggregateCheckpoint
{
    /**
     * @var \PoPCMSSchema\UserState\Checkpoints\UserLoggedInCheckpoint|null
     */
    private $userLoggedInCheckpoint;
    /**
     * @var \PoP\Engine\Checkpoints\DoingPostCheckpoint|null
     */
    private $doingPostCheckpoint;
    public final function setUserLoggedInCheckpoint(UserLoggedInCheckpoint $userLoggedInCheckpoint) : void
    {
        $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
    }
    protected final function getUserLoggedInCheckpoint() : UserLoggedInCheckpoint
    {
        if ($this->userLoggedInCheckpoint === null) {
            /** @var UserLoggedInCheckpoint */
            $userLoggedInCheckpoint = $this->instanceManager->getInstance(UserLoggedInCheckpoint::class);
            $this->userLoggedInCheckpoint = $userLoggedInCheckpoint;
        }
        return $this->userLoggedInCheckpoint;
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
        return [$this->getDoingPostCheckpoint(), $this->getUserLoggedInCheckpoint()];
    }
}
